<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function checkout1(){
        $user=Auth::user();
        return view('frontend.pages.checkout.checkout1',compact('user'));
    }
    public function checkout1Store(Request $request)
    {
//        echo "<pre>";
//        print_r($request->all());
        Session::put('checkout',[
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'country'=>$request->country,
            'address'=>$request->address,
            'city'=>$request->city,
            'state'=>$request->state,
            'postcode'=>$request->postcode,
            'note'=>$request->note,

            'shipping_first_name'=>$request->shipping_first_name,
            'shipping_last_name'=>$request->shipping_last_name,
            'shipping_email'=>$request->shipping_email,
            'shipping_phone'=>$request->shipping_phone,
            'shipping_country'=>$request->shipping_country,
            'shipping_address'=>$request->shipping_address,
            'shipping_city'=>$request->shipping_city,
            'shipping_state'=>$request->shipping_state,
            'shipping_postcode'=>$request->shipping_postcode,
        ]);

        $shippings=Shipping::where('status','active')->orderBy('shipping_address','ASC')->get();
        return view('frontend.pages.checkout.checkout2',compact('shippings'));

    }

    public function checkout2Store(Request $request){
//        echo "<pre>";
//        print_r($request->all());
//        exit();

        $this->validate($request,[
            'delivery_charge'=>'required|numeric'
        ]);
        Session::push('checkout',[
            'delivery_charge'=>$request->delivery_charge,
        ]);
        return view('frontend.pages.checkout.checkout3');
    }
    public function checkout3Store(Request $request){
//        echo "<pre>";
//        print_r($request->all());
        $this->validate($request,[
            'payment_method'=>'required|string'
        ]);
        Session::push('checkout',[
            'payment_method'=>$request->payment_method,
            'payment_status'=>'unpaid',
        ]);

//        echo "<pre>";
//        print_r(Session::get('checkout'));
//        echo Session::get('checkout')['shipping_first_name'];
//
//        foreach (Session::get('checkout') as $key=>$item){
//            echo "<br/>";
//            $num=floatval($key);
//            echo Session::get('checkout')[$num]["delivery_charge"];
////            if(is_array($item)){
////                foreach ($item as $key1=>$x){
////                    if(Session::get('checkout')[$key]["delivery_charge"]){
////                        echo Session::get('checkout')[$key][$key1];
////                    }
////
////                }
////            }else{
//////                echo $item;
////            }
//        }

        $sub_total=(float) str_replace(',','',Cart::instance('shopping')->subtotal());
//        echo $sub_total;
//        var_dump($sub_total);
        $delivery_charge=Session::get('checkout')[0]['delivery_charge'];
        if(Session::has('coupon')){
            $coupon_value=Session::get('coupon')['value'];
            return view('frontend.pages.checkout.checkout4',compact(['sub_total','coupon_value','delivery_charge']));
        }
        else{
            $coupon_value=0;
            return view('frontend.pages.checkout.checkout4',compact(['sub_total','coupon_value','delivery_charge']));
        }

    }

    public function checkoutStore(){
//        echo "<pre>";
//        print_r(Session::get('checkout'));

        $order= new Order();

        $order['user_id']= auth()->user()->id;
        $order['order_number']=Str::upper('ORD-'.Str::random(6));
        $order['quantity']=Cart::instance('shopping')->count();

        $order['sub_total']=(float) str_replace(',','',Cart::instance('shopping')->subtotal());
        if(Session::has('coupon')){
            $order['coupon']=Session::get('coupon')['value'];
        }else{
            $order['coupon']=0;
        }
        $order['delivery_charge']=Session::get('checkout')[0]['delivery_charge'];
        $order['total_amount']= $order['sub_total'] +$order['delivery_charge'] - $order['coupon'];

        $order['payment_method']=Session::get('checkout')[1]['payment_method'];
        $order['payment_status']=Session::get('checkout')[1]['payment_status'];
        $order['condition']="pending";

        $order['first_name']=Session::get('checkout')['first_name'];
        $order['last_name']=Session::get('checkout')['last_name'];
        $order['email']=Session::get('checkout')['email'];
        $order['phone']=Session::get('checkout')['phone'];
        $order['country']=Session::get('checkout')['country'];
        $order['address']=Session::get('checkout')['address'];
        $order['city']=Session::get('checkout')['city'];
        $order['state']=Session::get('checkout')['state'];
        $order['postcode']=Session::get('checkout')['postcode'];
        $order['note']=Session::get('checkout')['note'];

        $order['shipping_first_name']=Session::get('checkout')['shipping_first_name'];
        $order['shipping_last_name']=Session::get('checkout')['shipping_last_name'];
        $order['shipping_email']=Session::get('checkout')['shipping_email'];
        $order['shipping_phone']=Session::get('checkout')['shipping_phone'];
        $order['shipping_country']=Session::get('checkout')['shipping_country'];
        $order['shipping_address']=Session::get('checkout')['shipping_address'];
        $order['shipping_city']=Session::get('checkout')['shipping_city'];
        $order['shipping_state']=Session::get('checkout')['shipping_state'];
        $order['shipping_postcode']=Session::get('checkout')['shipping_postcode'];

//        Mail::to($order['email'])->bcc($order['shipping_email'])->cc('shanjoy.swe@gmail.com')->send(new OrderMail($order));
//        dd('Mail is sent');
        $status=$order->save();

        foreach(Cart::instance('shopping')->content() as $item){
            $product_id[]=$item->id;
            $product=Product::find($item->id);
            $quantity=$item->qty;
            $order->products()->attach($product,['quantity'=>$quantity]);
        }

        if($status){
            Mail::to($order['email'])->bcc($order['shipping_email'])->cc('shanjoy.swe@gmail.com')->send(new OrderMail($order));
            Cart::instance('shopping')->destroy();
            Session::forget('coupon');
            Session::forget('checkout');
            return redirect()->route('checkout.complete',$order['order_number'])
                ->with('success','Successfully saved your order');
        }else{
            return redirect()->route('checkout1') ->with('error','Please try again!');
        }
    }

    public function checkoutComplete($order){
        $order=$order;
        return view('frontend.pages.checkout.complete',compact('order'));

    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(){
        return view('frontend.pages.cart.index');
    }

    public function cartStore(Request $request){
        $product_id=$request->input('product_id');
        $product_qty=$request->input('product_qty');
        $product=Product::getProductByCart($product_id);
        $price=$product[0]['offer_price'];


        $cart_array=[];

        foreach (Cart::instance('shopping')->content() as $item){
            $cart_array[]=$item->id;
        }

        $result=Cart::instance('shopping')
            ->add($product_id,$product[0]['title'],$product_qty,$price
            )->associate('App\Models\Product');
//        return $result;
        if($result){
            $response['status']=true;
            $response['product_id']=$product_id;
            $response['total']=Cart::subtotal();
            $response['cart_count']=Cart::instance('shopping')->count();
            $response['message']="Item was added to your card";
        }

//        for page load
        if($request->ajax()){
            $header=view('frontend.layouts.header')->render();
            $response['header']=$header;
//            $cart_index=view('frontend.pages.cart.index')->render();
//            $response['cart_index']=$cart_index;
        }
        return json_encode($response);
    }

    //Cart delete
    public function cartDelete(Request $request){
        $id=$request->input('cart_id');

        Cart::instance('shopping')->remove($id);


        $response['status']=true;
        $response['total']=Cart::subtotal();
        $response['cart_count']=cart::instance('shopping')->count();
        $response['message']="Cart Successfully Removed";


        if($request->ajax()){
            $header=view('frontend.layouts.header')->render();
            $response['header']=$header;
            $cart_list=view('frontend.layouts._cart-lists')->render();
            $response['cart_list']=$cart_list;
//            $cart_index=view('frontend.pages.cart.index')->render();
//            $response['cart_index']=$cart_index;
        }
        return json_encode($response);
    }

    public function cartUpdate(Request $request){
//        dd($request->all());
        $this->validate($request,[
           'product_qty'=>'required|numeric',
        ]);
        $rowId=$request->input('rowId');
        $request_quantity=$request->input('product_qty');
        $productQuantity=$request->input('productQuantity');
        if($request_quantity>$productQuantity){
            $message="we currently do not have enough items in stock";
            $response['status']=false;

        }
        elseif($request_quantity<1){
            $message="You Can not add less than 1 quantity";
            $response['status']=false;
        }
        else{
            Cart::instance('shopping')->update($rowId,$request_quantity);
            $message="Quantity was updated Successfully";
            $response['status']=true;
            $response['message']=$message;
            $response['total']=Cart::subtotal();
            $response['cart_count']=cart::instance('shopping')->count();
        }

        if($request->ajax()){
            $header=view('frontend.layouts.header')->render();
            $cart_list=view('frontend.layouts._cart-lists')->render();
            $response['cart_list']=$cart_list;
            $response['header']=$header;
        }
        return $response;
    }
    //coupon
    public function couponAdd(Request $request){
        $coupon=Coupon::where('code',$request->input('code'))->first();
        if(!$coupon){
            return back()->with('error', 'Invalid coupon code, please enter a valid coupon code');
        }
        if($coupon){
            $total_price=(float) str_ireplace(',','',Cart::instance('shopping')->subtotal());
            session()->put('coupon',[
                'id'=>$coupon->id,
                'code'=>$coupon->code,
                'value'=>$coupon->discount($total_price),
            ]);
            return back()->with('success','Coupon applied successfully');
        }
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Testing\Fluent\Concerns\Has;

class IndexController extends Controller
{
    public function home(){
        $banners=Banner::where(['status'=>'active', 'condition'=>'banner'])->orderBy('id','DESC')->limit(4)->get();
        $categories=Category::where(['status'=>'active','is_parent'=>1])->orderBy('id','DESC')->limit(3)->get();

        return view('frontend.index',compact(['banners','categories']));
    }

    public function ProductCategory(Request $request,$slug){
        $categories=Category::with(['products'])->where('slug',$slug)->first();

        $sort='';
        if($request->sort!=null){
            $sort=$request->sort;
        }
        if($categories==null){
            return view('errors.404');
        }
        else{
            if($sort=='priceAsc'){
               $products=Product::where(['status'=>'active','cat_id'=>$categories->id])
                   ->orderBy('offer_price','ASC')->paginate(12);
            }
            elseif ($sort=='priceDesc'){
                $products=Product::where(['status'=>'active','cat_id'=>$categories->id])
                    ->orderBy('offer_price','DESC')->paginate(12);
            }
            elseif ($sort=='discountAsc'){
                $products=Product::where(['status'=>'active','cat_id'=>$categories->id])
                    ->orderBy('discount','ASC')->paginate(12);
            }
            elseif ($sort=='discountDesc'){
                $products=Product::where(['status'=>'active','cat_id'=>$categories->id])
                    ->orderBy('discount','DESC')->paginate(12);
            }
            elseif ($sort=='titleAsc'){
                $products=Product::where(['status'=>'active','cat_id'=>$categories->id])
                    ->orderBy('title','ASC')->paginate(12);
            }
            elseif ($sort=='titleDesc'){
                $products=Product::where(['status'=>'active','cat_id'=>$categories->id])
                    ->orderBy('title','DESC')->paginate(12);
            }
            else{
                $products=Product::where(['status'=>'active','cat_id'=>$categories->id])->paginate(4);
            }
        }

        $route='product-category';
//
//        // data loading with ajax
//        if($request->ajax()){
//            $view=view('frontend.layouts._single-product',compact('products'))->render();
//            return response()->json(['html'=>$view]);
//        }

        return view('frontend.pages.product.product-category',compact(['categories','route','products']));
    }

    //load Product with Ajax
    public function loadProduct(Request $request, $slug){
        $categories=Category::with(['products'])->where('slug',$slug)->first();
        $products=Product::where(['status'=>'active','cat_id'=>$categories->id])->paginate(4);

        if($request->ajax()){
            $view=view('frontend.layouts._single-product',compact('products'))->render();
            return response()->json(['html'=>$view]);
        }

    }

    public function productDetail($slug){
        $product=Product::with(['related_product'])->where('slug',$slug)->first();
        // dd($product);
        if($product){
        return view('frontend.pages.product.product-detail',compact('product'));
        }
        else{
            return 'Product detail not found';
        }
    }

    //user auth
    public function UserAuth(){
        return view('frontend.auth.auth');
    }

    //login submit
    public function loginSubmit(Request $request){
        $this->validate($request,[
            'email'=>'email|required|exists:users,email',
            'password'=>'required|min:4'
        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'username'=>'admin' ,'status'=>'active'])){
            Session::put('admin',$request->email);
            if(Session::get('url.intended')){
                return Redirect::to(Session::get('url.intended'));
            }
            else{
                return redirect()->route('home')->with('success', 'Successfully logged in');
            }
        }
        elseif(Auth::attempt(['email'=>$request->email, 'password'=>$request->password,'status'=>'active'])){
            Session::put('user',$request->email);

            if(Session::get('url.intended')){
                return Redirect::to(Session::get('url.intended'));
            }
            else{
                return redirect()->route('user.home')->with('success', 'Successfully logged in');
            }

        }
        else{
            return back()->with('error','invalid Email and password');

        }
    }
    public function registerSubmit(Request $request){
//        return $request->all();
        $this->validate($request,[
            'full_name'=>'required|string',
            'username'=>'nullable|string|unique:users,username',
            'email'=>'email|required|unique:users,email',
            'password'=>'required|min:4|confirmed'
        ]);
        $data=$request->all();
        $check=$this->create($data);
        Session::put('user',$data['email']);
        Auth::login($check);
        if($check){
            return redirect()->route('user.home')->with('success', 'Successfully Register');;
        }
        else{
            return back();
        }
    }
    private function create(array $data){
        return User::create([
            'full_name'=>$data['full_name'],
            'username'=>$data['username'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
        ]);
    }
    public function LogoutSubmit(Request $request){
        Session::forget('user');
        Auth::logout();
        return redirect()->route('user.home')->with('success','you have been logged out');
    }
//    public function userLogout(Request $request){
//        auth()->logout();
//
//        $request->session()->invalidate();
//        $request->session()->regenerateToken();
//
//        return redirect()->route('user.home')->with('success','you have been logged out');
//
//    }

    public function userDashboard(){
            $user=Auth::user();

            return view('frontend.user.dashboard',compact('user'));
    }
    public function userOrder(){
        $user=Auth::user();

        return view('frontend.user.order',compact('user'));
    }

    public function userAddress(){
        $user=Auth::user();
        return view('frontend.user.address',compact('user'));
    }
    //Billing or edit address
    public function billingAddress(Request $request,$id){
    //dd($request->all());
//        $user=User::where('id',$id)->get();
//        return $user;
        $user=User::where('id',$id)->update([
            'country'=>$request->country,
            'city'=>$request->city,
            'postcode'=>$request->postcode,
            'state'=>$request->state,
            'address'=>$request->address,
        ]);
        if($user){
            return back()->with('success','Billing Address successfully updated');
        }
        else{
            return back()->with('error','Somethig went wrong');
        }
    }
    //Shipping  address
    public function shippingAddress(Request $request,$id){
//        dd($request->all());
//        $user=User::where('id',$id)->get();
//        return $user;
        $user=User::where('id',$id)->update([
            'shiping_country'=>$request->shiping_country,
            'shiping_city'=>$request->shiping_city,
            'shiping_postcode'=>$request->shiping_postcode,
            'shiping_state'=>$request->shiping_state,
            'shiping_address'=>$request->shiping_address,
        ]);
        if($user){
            return back()->with('success','Shipping Address successfully updated');
        }
        else{
            return back()->with('error','Somethig went wrong');
        }
    }

    public function userAccount(){
        $user=Auth::user();

        return view('frontend.user.account',compact('user'));
    }
    //account Update
    public function updateAccount(Request $request,$id){
        $hashpassword=Auth::user()->password;
//        return $hashpassword;
//        return $request->all();
        if(!$request->oldpassword==null && $request->newpassword==null){
            $data=$request->validate([
                'full_name'=>'required|string',
                'phone'=>'nullable',
            ]);
            if(Hash::check($request->oldpassword,$hashpassword)){
                User::where('id',$id)->update([
                    'full_name'=>$request->full_name,
                    'phone'=>$request->phone,
                ]);
                return back()->with('success','Account successfully updated ');
            }
            else{
                return back()->with('error',"Password does not match");
            }

        }
        else{
            if(Hash::check($request->oldpassword,$hashpassword)){
                if(!Hash::check($request->newpassword,$hashpassword)){
                    $data=$request->validate([
                        'full_name'=>'required|string',
                        'phone'=>'nullable',
                        'newpassword'=>'required|min:4'
                    ]);
//                    $data['password']=bcrypt($data['newpassword']);
//                    User::where('id',$id)->update($data);
                    User::where('id',$id)->update([
                        'full_name'=>$request->full_name,
                        'phone'=>$request->phone,
                        'password'=>bcrypt($request->newpassword),
                    ]);
                    return back()->with('success','Account successfully updated ');
                }else{
                    return back()->with('error','new password can not be save with old password');
                }
            }
            else{
                return back()->with('error',"Old password does not save");
            }

        }

    }
}


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
                $products=Product::where(['status'=>'active','cat_id'=>$categories->id])->paginate(12);
            }
        }

        $route='product-category';


        if($request->ajax()){
            $view=view('frontend.layouts._single-product',compact('products'))->render();
            return response()->json(['html'=>$view]);
        }
        return view('frontend.pages.product.product-category',compact(['categories','route','products']));
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
}


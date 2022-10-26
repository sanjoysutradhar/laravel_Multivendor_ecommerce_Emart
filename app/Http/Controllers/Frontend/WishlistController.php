<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function wishlist(){
      return view('frontend.pages.wishlist');
    }

    public function wishlistStore(Request $request){
        $product_id=$request->input('product_id');
        $product_qty=$request->input('product_qty');
        $product=Product::getProductByCart($product_id);
        $price=$product[0]['offer_price'];

        $wishlist_array=[];

        foreach(Cart::instance('wishlist')->content() as $item){
            $wishlist_array[]=$item->id;
        }

        if(in_array($product_id,$wishlist_array)){
            $response['present']=true;
            $response['message']="Item already in your wishlist";
        }
        else{
            $result= Cart::instance('wishlist')->add($product_id,$product[0]['title'],$product_qty,$price)
                ->associate('App\Models\Product');
            if($result){
                $response['status']=true;
                $response['message']="Item has been saved in wishlist";
                $response['wishlist_count']=Cart::instance('wishlist')->count();
            }
        }
        return $response;

    }
    public function moveToCart(Request $request){
       $item=Cart::instance('wishlist')->get($request->input('rowId'));

        Cart::instance('wishlist')->remove($request->input('rowId'));
        $result= Cart::instance('shopping')->add($item->id,$item->name,1,$item->price)
            ->associate('App\Models\Product');

        if($result) {
            $response['status'] = true;
            $response['message'] = "Item has been move to cart";
            $response['cart_count'] = Cart::instance('shopping')->count();
        }

        if($request->ajax()){
            $header=view('frontend.layouts.header')->render();
            $response['header']=$header;
            $wishlist_list=view('frontend.layouts._wishlist')->render();
            $response['wishlist_list']=$wishlist_list;
        }
        return $response;
    }
    public function wishlistDelete(Request $request){
        $id=$request->input('rowId');

        Cart::instance('wishlist')->remove($id);


        $response['status'] = true;
        $response['message'] = "Item has been deleted from wishlist";
        $response['cart_count'] = Cart::instance('shopping')->count();


        if($request->ajax()){
            $header=view('frontend.layouts.header')->render();
            $response['header']=$header;
            $wishlist_list=view('frontend.layouts._wishlist')->render();
            $response['wishlist_list']=$wishlist_list;
        }
        return $response;
    }
}

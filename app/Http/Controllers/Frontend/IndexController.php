<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(){
        $banners=Banner::where(['status'=>'active', 'condition'=>'banner'])->orderBy('id','DESC')->limit('4')->get();
        // dd($banners);
        return view('frontend.index',compact('banners'));
    }
}

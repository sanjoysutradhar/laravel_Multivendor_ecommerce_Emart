<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function setting(){
        return view('backend.setting.setting',['setting'=>Setting::first()]);
    }
    public function update(Request $request, $id){
//        return $request->all();
        $this->validate($request,[
            'title'=>'string|required',
            'meta_description'=>'string|nullable',
            'meta_keywords'=>'string|nullable',
            'logo'=>'required',
            'favicon'=>'required',
            'address'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'fax'=>'required',
            'footer'=>'required',
            'facebook_url'=>'string|nullable',
            'twitter_url'=>'string|nullable',
            'linked_url'=>'string|nullable',
            'pinterest_url'=>'string|nullable',
        ]);
        $data=$request->all();
        $setting=Setting::find($id);
        $status=$setting->fill($data)->save();
        if($status){
            // return back()->with('success','Successfully created banner');
            return redirect('/admin/setting')->with('success','Successfully created banner');
        }
        else{
            return back()->with('errors','Something went wrong');
        }
    }
}

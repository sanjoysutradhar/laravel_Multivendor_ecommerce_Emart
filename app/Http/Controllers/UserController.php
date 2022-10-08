<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::orderBy('id','DESC')->get();
        return view('backend.user.index',compact('users'));
    }

    public function user_status(Request $request){
        if($request->mode=='true'){
            DB::table('users')->where('id',$request->id)->update(['status'=>'active']);
        }
        else{
            DB::table('users')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfully updated status','status'=>true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'full_name'=>'string|required',
            'username'=>'string|nullable',
            'email'=>'email|required|unique:users,email',
            'password'=>'min:4|required',
            'phone'=>'string|nullable',
            'photo'=>'string|required',
            'address'=>'string|nullable',
            
            'role'=>'required|in:admin,vendor,customer',
            'status'=>'required|in:active,inactive'
        ]);
        
        $data=$request->all();
        $data['password']=Hash::make($request->password);
    
        $status=User::create($data);
        if($status){
            return redirect()->route('user.index')->with('success','Successfully created user');
        }
        else{
            return back()->with('errors','Something went wrong');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users=User::find($id);
        
        if($users){
            return view('backend.user.edit',compact('users'));
        }
        else{
            return back()->with('errors','Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $users=User::find($id);
        if($users){
            $this->validate($request,[
                'full_name'=>'string|required',
                'username'=>'string|nullable',
                'email'=>'email|required|exists:users,email',
                'phone'=>'string|nullable',
                'photo'=>'string|required',
                'address'=>'string|nullable',
                'role'=>'required|in:admin,vendor,customer',
                'status'=>'required|in:active,inactive'
            ]);

            $data=$request->all();
            $status=$users->fill($data)->save();
            if($status){
                return redirect()->route('user.index')->with('success','Successfully Updated user');
            }
            else{
                return back()->with('errors','Something went wrong');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users=User::find($id);
       
        if($users){
            $status=$users->delete();
            if($status){
                
                return redirect()->route('user.index')->with('success','user successfully deleted');
            }
            else{
                return back()->with('errors','Something wrong');
            }
        }else{
            return back()->with('errors','Data not found');
        }
    }
}

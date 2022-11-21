<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function currencyLoad(Request $request){
        // return $request->all();
        session()->put('currency_code',$request->currency_code);
        $currency=Currency::where('code',$request->currency_code)->first();
        session()->put('currency_symbol',$currency->symbol);
        session()->put('currency_exchange_rate',$currency->exchange_rate);

        $response['status']=true;
        return $response;
    }
    public function index()
    {
        $currencies=Currency::orderBy('id','DESC')->get();
        return view('backend.currency.index',compact('currencies'));
    
    }

    public function currencyStatus(Request $request){
        if($request->mode=='true'){
            DB::table('currencies')->where('id',$request->id)->update(['status'=>'active']);
        }
        else{
            DB::table('currencies')->where('id',$request->id)->update(['status'=>'inactive']);
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
        return view('backend.currency.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $this->validate($request,[
            'name'=>'string|required',
            'symbol'=>'string|required',
            'exchange_rate'=>'numeric|required',
            'code'=>'string|required',
            'status'=>'nullable|in:active,inactive'
        ]);

        Currency::newCurrency($request);
        // $status=Currency::newCurrency($request);
        return redirect()->route('currency.index')->with('success','Successfully created currency');
        // if($status){
        //     return redirect()->route('currency.index')->with('success','Successfully created currency');
        // }
        // else{
        //     return back()->with('errors','Something went wrong');
        // }

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
        $currency=Currency::find($id);

        return view('backend.currency.edit',compact('currency'));
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

        $this->validate($request,[
            'name'=>'string|required',
            'symbol'=>'string|required',
            'exchange_rate'=>'numeric|required',
            'code'=>'string|required',
            'status'=>'nullable|in:active,inactive'
        ]);

        $status=Currency::updateCurrency($request,$id);
        if($status){
            return redirect()->route('currency.index')->with('success','Successfully Updated currency');
        }
        else{
            return back()->with('errors','Something went wrong');
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
        $status=Currency::deleteCurrency($id);
        if($status){
            return redirect()->route('currency.index')->with('success','Successfully Deleted currency');
        }
        else{
            return back()->with('errors','Something went wrong');
        }
    }
}

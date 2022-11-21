<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    // protected $fillable=[
    //     'name',
    //     'symbol',
    //     'exchange_rate',
    //     'code',
    //     'status',
    // ];

        private static $currency, $currencies;

        public static function newCurrency($request){
            self::$currency=new Currency();
            self::$currency->name=$request->name;
            self::$currency->symbol=$request->symbol;
            self::$currency->exchange_rate=$request->exchange_rate;
            self::$currency->code=$request->code;
            self::$currency->status=$request->status;
            self::$currency->save();
        }

        public static function updateCurrency($request,$id){
            self::$currency= Currency::find($id);
            self::$currency->name=$request->name;
            self::$currency->symbol=$request->symbol;
            self::$currency->exchange_rate=$request->exchange_rate;
            self::$currency->code=$request->code;
            self::$currency->status=$request->status;
            return self::$currency->save();

        }

        public static function deleteCurrency($id){
            self::$currency= Currency::find($id);
            return self::$currency->delete();
        }
}

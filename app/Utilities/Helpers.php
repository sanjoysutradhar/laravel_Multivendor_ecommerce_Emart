<?php
use App\Models\Currency;
use Illuminate\Support\Facades\Session;

class helper{
    public static function userDefaultImage(){
        return asset('frontend/img/default.jpg');
    }
    public static function minPrice(){
        return floor(\App\Models\Product::min('offer_price'));
    }
    public static function maxPrice(){
        return floor(\App\Models\Product::max('offer_price'));
    }
    public static function currencyLoad(){
        if(session()->has('system_default_currency_info')){
            session()->put('system_default_currency_info',Currency::find(1));
        }
    }

    // currency converter
    public static function currencyConverter($amount){
        return formatPrice(convertPrice($amount));
        
    }
}

//Cover price

if(!function_exists('convertPrice')){
    function convertPrice($price){
        // Helper::currencyLoad();
        session()->put('system_default_currency_info',Currency::find(1));
        $system_default_currency_info=session('system_default_currency_info');

        // dd($system_default_currency_info);
        // exit();
        // $system_default_currency_info=session('system_default_currency_info');
        $price=floatval($price)/floatval($system_default_currency_info->exchange_rate);

        if(Session::has('currency_exchange_rate')){
            $exchange=session('currency_exchange_rate');
        }else{
            $exchange=$system_default_currency_info;
        }
        $price=floatval($price)*floatval($exchange);

        return $price;
    }
}
//Currency Symbol
if(!function_exists('currencySymbol')){
    function currencySymbol($price){
        Helper::currencyLoad();
        if(Session::has('currency_symbol')){
            $symbol=session('currency_symbol');
        }else{
            $system_default_currency_info=session('system_default_currency_info');

            $symbol=$system_default_currency_info->symbol;
        }

        return $symbol;
    }
}
//format price
if(!function_exists('formatPrice')){
    function formatPrice($price){
        return currencySymbol($price).number_format($price,2);
    }
}
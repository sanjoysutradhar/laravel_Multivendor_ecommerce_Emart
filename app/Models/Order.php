<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id','order_number','product_id','sub_total',
        'total_amount','quantity','delivery_charge','coupon',

        'first_name','last_name','email','phone','address','state',
        'country','city','postcode','note',

        'shipping_first_name','shipping_last_name','shipping_email','shipping_phone','shipping_address',
        'shipping_country','shipping_city','shipping_state','shipping_postcode',
    ];
}

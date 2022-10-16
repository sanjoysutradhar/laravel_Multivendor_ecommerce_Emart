<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =[
        
        'title',
        'slug',
        'summary',
        'description',
        'stock',
        'photo',
        'price',
        'offer_price',
        'discount',
        'size',
        'condition',
        'vendor_id',
        'brand_id',
        'cat_id',
        'child_cat_id',	
    ];

    // public function brands(){
    //     return $this->belongsTo('App\Models\Brand');
    // }
    public function related_product(){
        return $this->hasMany('App\Models\Product','cat_id','cat_id')->where('status','active')->limit(10);
    }
}

<?php

namespace App\Models;

use App\Models\Product;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'slug',
        'summary',
        'photo',
        'is_parent',
        'status',
        'parent_id'
    ];
    public static function shifChild($cat_id){
        return Category::whereIn('id',$cat_id)->update(['is_parent'=>1]);
    }
    public static function getChildByParentID($id){
        return Category::whereIn('parent_id',$id)->pluck('title','id');
    }

    public function products(){
        return $this->hasMany('App\Models\Product', 'cat_id','id');
    }
}

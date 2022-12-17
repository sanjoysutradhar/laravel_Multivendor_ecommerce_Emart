<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'title'=>'E-mart online shopping',
                'meta_description'=>'E-mart online shopping',
                'meta_keywords'=>'E-mart, Online shopping, E-commerce website',
                'logo'=>'frontend\img\core-img\logo.png',
                'favicon'=>'',
                'address'=>'Dhaka, Bangladesh',
                'email'=>'info@emart.com',
                'phone'=>'+8801601845222',
                'fax'=>'002 78956 564812',
                'footer'=>'Shanjoy SutraDhar',
                'facebook_url'=>'',
                'twitter_url'=>'',
                'linked_url'=>'',
                'pinterest_url'=>'',
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
        [
            [
                'full_name'=>'sanjoy customer',
                'username'=>'customer',
                'email'=>'customer@gmail.com',
                'password'=>Hash::make('12345678'),
                'status'=>'active'
            ]
        ]);

        // Admin
        DB::table('admins')->insert(
            [
                [
                    'full_name'=>'sanjoy admin',
                    'email'=>'admin@gmail.com',
                    'password'=>Hash::make('12345678'),
                    'status'=>'active'
                ]
            ]);
            
        //Seller
//        DB::table('sellers')->insert(
//        [
//            [
//                'full_name'=>'sanjoy seller',
//                'username'=>'seller',
//                'email'=>'seller@gmail.com',
//                'password'=>Hash::make('12345678'),
//                'status'=>'active'
//            ]
//        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert(
            [
                [
                    'name'=>'USA Doller',
                    'symbol'=>'$',
                    'exchange_rate'=>'1',
                    'code'=>'USD',
                ],
                [
                    'name'=>'BD taka',
                    'symbol'=>'Rs.',
                    'exchange_rate'=>'85',
                    'code'=>'tk',
                ]
            ]
        );
    }
}

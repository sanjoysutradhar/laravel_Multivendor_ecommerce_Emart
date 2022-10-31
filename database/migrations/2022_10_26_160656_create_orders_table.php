<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('order_number','10')->unique();
            $table->float('sub_total')->default(0);
            $table->float('total_amount')->default(0);
            $table->float('coupon')->default(0)->nullable();
            $table->string('payment_method')->default('COD');
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
            $table->enum('condition',['pending','processing','complete','cancel'])->default('pending');
            $table->float('delivery_charge')->default(0)->nullable();
            $table->integer('quantity')->default(0);


            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('country');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('postcode')->nullable();
            $table->mediumText('note');

            $table->string('shipping_first_name');
            $table->string('shipping_last_name');
            $table->string('shipping_email')->unique();
            $table->string('shipping_phone');
            $table->string('shipping_country');
            $table->string('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_state');
            $table->string('shipping_postcode')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};

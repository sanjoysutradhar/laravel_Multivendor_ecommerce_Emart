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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->enum('status',['active','inactive'])->default('active');

            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('state')->nullable();
            $table->string('address')->nullable();

            $table->string('shiping_country')->nullable();
            $table->string('shiping_city')->nullable();
            $table->string('shiping_postcode')->nullable();
            $table->string('shiping_state')->nullable();
            $table->string('shiping_address')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};

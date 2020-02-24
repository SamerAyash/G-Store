<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); ///////////////////////////////// it's useless
            $table->string('userName')->unique();
            $table->string('firstName');
            $table->string('lastName');
            $table->bigInteger('id_number');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->string('image')->default('default.jpg');
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->date('birthDate');
            $table->enum('type',['seller','buyer']);
            $table->bigInteger('productsCount')->default(0);
            $table->string('shopName')->nullable();
            $table->float('totalAmount')->default(0.0);
            $table->string('notes')->nullable();
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
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description');
            $table->string('mainImage');
            $table->float('price');
            $table->integer('amount');
            $table->float('rate');
            $table->bigInteger('ratingCount');
            $table->string('brand');
            $table->boolean('isHidden')->default(false);
            $table->boolean('isAccept')->default(false);
            $table->unsignedBigInteger('subCategory_id');
            $table->foreign('subCategory_id')->references('id')->on('sub_categories');
            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('adminName')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('products');
    }
}

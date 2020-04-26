<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeautyAndHelthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beauty_and_helths', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('size');
            $table->enum('for',['men','women','both']);
            $table->enum('power',['battery','electricity','both'])->nullable();
            $table->enum('type',['perfume','make-up','body care device','cream']);
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('beauty_and_helths');
    }
}

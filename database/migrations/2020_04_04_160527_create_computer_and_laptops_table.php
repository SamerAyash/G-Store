<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComputerAndLaptopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computer_and_laptops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('displaySize');
            $table->string('processor');
            $table->integer('diskSize');
            $table->integer('ssdSize');
            $table->integer('ram');
            $table->enum('type',['computer','laptop']);
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
        Schema::dropIfExists('computer_and_laptops');
    }
}

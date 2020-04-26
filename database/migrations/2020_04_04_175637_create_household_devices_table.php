<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseholdDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('household_devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type',['cooktops','coffee machine','food processor','blender',
                'air fryer','kettle','water dispenser','mixer','waffle maker','iron','fan'
            ,'sewing machine','washing machine','refrigerator','oven & toaster','microwave']);
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
        Schema::dropIfExists('household_devices');
    }
}

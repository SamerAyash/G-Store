<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileAndTabletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_and_tablets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ram');
            $table->integer('storage');
            $table->enum('sim',['single','dual']);
            $table->integer('battery');
            $table->smallInteger('displaySize');
            $table->smallInteger('backCamera');
            $table->smallInteger('rearCamera');
            $table->enum('type',['mobile','tablet']);
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('mobile_and_tablets');
    }
}

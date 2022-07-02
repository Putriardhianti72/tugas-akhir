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
        Schema::create('retail_order_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('retail_order_id')->unsigned();
            $table->bigInteger('retail_product_id')->unsigned()->nullable();
            $table->string('code');
            $table->string('product_name');
            $table->text('desc')->nullable();
            $table->integer('price')->default(0);
            $table->integer('qty')->default(0);
            $table->integer('weight')->unsigned()->default(0);
            $table->string('pict')->nullable();
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
        Schema::dropIfExists('retail_order_products');
    }
};

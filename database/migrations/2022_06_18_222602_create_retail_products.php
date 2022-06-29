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
        Schema::create('retail_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('retail_brand_id')->unsigned();
            $table->string('product_name');
            $table->text('desc')->nullable();
            $table->integer('price')->default(0);
            $table->string('pict')->nullable();
            $table->integer('stock')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('retail_products');
    }
};

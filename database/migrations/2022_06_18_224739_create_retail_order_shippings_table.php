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
        Schema::create('retail_order_shippings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('retail_order_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('alamat')->nullable();
            $table->bigInteger('province_id')->unsigned()->nullable();
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->bigInteger('subdistrict_id')->unsigned()->nullable();
            $table->string('postal_code')->nullable();
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
        Schema::dropIfExists('retail_order_shippings');
    }
};

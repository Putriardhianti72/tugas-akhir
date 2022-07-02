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
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->integer('price')->default(0);
            $table->string('weight')->nullable();
            $table->string('etd')->nullable();
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

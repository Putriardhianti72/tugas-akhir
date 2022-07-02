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
        Schema::create('retail_order_customers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('retail_order_id')->unsigned();
            $table->string('uid')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('password')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('alamat')->nullable();
            $table->bigInteger('province_id')->unsigned()->nullable();
            $table->string('province_name')->nullable();
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->string('city_name')->nullable();
            $table->bigInteger('subdistrict_id')->unsigned()->nullable();
            $table->string('subdistrict_name')->nullable();
            $table->string('postal_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retail_order_customers');
    }
};

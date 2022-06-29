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
        Schema::create('order_members', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->string('uid')->nullable();
            $table->string('nama');
            $table->string('email');
            $table->string('hp')->nullable();
            $table->string('alamat1')->nullable();
            $table->string('alamat2')->nullable();
            $table->string('kota')->nullable();
            $table->string('propinsi')->nullable();
            $table->text('user_hash')->nullable();
            $table->text('token')->nullable();
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
        Schema::dropIfExists('order_members');
    }
};

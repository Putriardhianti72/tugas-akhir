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
        Schema::create('retail_order_payments', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->nullable();
            $table->bigInteger('retail_order_id')->unsigned();
            $table->bigInteger('destination_bank_id')->unsigned()->nullable();
            $table->integer('total_price')->default(0);
            $table->string('code')->nullable();
            $table->string('bank')->nullable();
            $table->string('va_number')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('card_type')->nullable();
            $table->string('currency')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('acc_owner')->nullable();
            $table->string('acc_number')->nullable();
            $table->string('payment_proof')->nullable();
            $table->string('payment_url')->nullable();
            $table->string('signature_key')->nullable();
            $table->string('fraud_status')->nullable();
            $table->string('transaction_status')->nullable();
            $table->dateTime('transaction_time')->nullable();
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
        Schema::dropIfExists('retail_order_payments');
    }
};

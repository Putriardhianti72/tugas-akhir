<?php

namespace App\Services\Midtrans;

use Exception;

class MidtransService
{
    public function __construct()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = env('MIDTRANS_PRODUCTION', false);
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }

    public function createTransaction(array $params)
    {
        $params = array_merge_recursive(array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            )
        ), $params);

        try {
          // Get Snap Payment Page URL
          $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;

          // Redirect to Snap Payment Page
          return $paymentUrl;
        }
        catch (Exception $e) {
          \Log::error($e);
        }
    }

    public function getStatus($orderId)
    {
        // {
        //   "masked_card": "481111-1114",
        //   "approval_code": "1578569243927",
        //   "bank": "bni",
        //   "eci": "05",
        //   "channel_response_code": "00",
        //   "channel_response_message": "Approved",
        //   "transaction_time": "2020-01-09 18:27:19",
        //   "gross_amount": "10000.00",
        //   "currency": "IDR",
        //   "order_id": "Postman-1578568851",
        //   "payment_type": "credit_card",
        //   "signature_key": "16d6f84b2fb0468e2a9cf99a8ac4e5d803d42180347aaa70cb2a7abb13b5c6130458ca9c71956a962c0827637cd3bc7d40b21a8ae9fab12c7c3efe351b18d00a",
        //   "status_code": "200",
        //   "transaction_id": "57d5293c-e65f-4a29-95e4-5959c3fa335b",
        //   "transaction_status": "settlement",
        //   "fraud_status": "accept",
        //   "settlement_time": "2020-01-10 16:15:31",
        //   "status_message": "Success, transaction is found",
        //   "merchant_id": "M004123",
        //   "card_type": "credit",
        //   "three_ds_version": "2",
        //   "challenge_completion": true
        // }

         // +"transaction_time": "2022-07-03 22:51:47"
         //  +"gross_amount": "390000.00"
         //  +"currency": "IDR"
         //  +"order_id": "[1756284473, "RINV000000012"]"
         //  +"payment_type": "gopay"
         //  +"signature_key": "a6ff3f204821ca2efe7277a44e90ef770cda2819ad8280fb7f0206715fcf48452d055d83a20137cb4d0619ee1090477841f61c06265ba456dcd7f883dd887d9b"
         //  +"status_code": "201"
         //  +"transaction_id": "f7013797-6302-4768-8129-63e6351d8709"
         //  +"transaction_status": "pending"
         //  +"fraud_status": "accept"
         //  +"status_message": "Success, transaction is found"
         //  +"merchant_id": "M098716"


        try {
            $response = \Midtrans\Transaction::status($orderId);

            return (array) $response ?: [];
        }
        catch (Exception $e) {
            dd($e);
            \Log::error($e);
            return [];
        }
    }
}

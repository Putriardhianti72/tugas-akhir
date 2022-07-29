<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\Partner\Api;

trait RetailTrait
{
    protected function getApiProduct(Request $request, $code)
    {
        $api = new Api();

        return $api->getProduct($this->getTemplateToken($request), $code) ?: [];
    }

    protected function getTemplateName(Request $request)
    {
        if ($request->domain === env('SAILENT_DOMAIN')) {
            return 'sailent';
        }

        if ($request->domain === env('KOPPEE_DOMAIN')) {
            return 'koppee';
        }
    }

    protected function getTemplateToken(Request $request)
    {
        $domain = $request->domain;

        if ($domain) {
            $product = OrderProduct::where('domain', $domain)->whereHas('order', function ($q) {
                $q->where('orders.status', Order::STATUS_COMPLETED);
            })->first();
            return $product->token;
        }
    }

    protected function getCarts(Request $request)
    {
        $carts = session('retail_cart.' . $request->domain);

        if (is_array($carts)) {
            foreach ($carts as $i => $cart) {
                if (! $cart['codeProduct']) {
                    unset($carts[$i]);
                }

                $cart['product'] = $this->getApiProduct($request, $cart['codeProduct']);
                $cart['qty'] = $cart['qty'] ?? 1;
                $carts[$i] = $cart;
            }
            return $carts;
        }
    }
}

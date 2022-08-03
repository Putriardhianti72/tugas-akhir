<?php

use App\Services\Partner\Auth;

if (! function_exists('admin_auth')) {
    function admin_auth() {
        return new Auth(Auth::ROLE_ADMIN);
    }
}

if (! function_exists('member_auth')) {
    function member_auth() {
        return new Auth(Auth::ROLE_MEMBER);
    }
}

if (! function_exists('format_currency')) {
    function format_currency($amount) {
        if (!$amount) {
            return 'Rp. 0';
        }
        return 'Rp. ' . number_format($amount ?: 0, 0, ',', '.');
    }
}

if (! function_exists('get_all_retail_products')) {
    function get_all_retail_products() {
        return [
            [
                'code' => 'PFLAVO',
                'product_name' => 'PROFLAVO',
            ],
            [
                'code' => 'SAVERION',
                'product_name' => 'SAVERION',
            ],
            [
                'code' => 'XFACE',
                'product_name' => 'XFACE',
            ],
        ];
    }
}

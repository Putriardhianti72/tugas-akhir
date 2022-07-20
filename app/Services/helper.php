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
        return number_format($amount ?: 0, 0, ',', '.');
    }
}

<?php

namespace App\Services\Partner;

use Illuminate\Support\Facades\Session;

class Auth
{
    public const ROLE_ADMIN = 'admin';
    public const ROLE_MEMBER = 'member';

    protected $api;
    protected $role;

    public function __construct(string $role)
    {
        $this->api = new Api();
        $this->role = $role;
    }

    public function check()
    {
        return (boolean) count($this->user()) && Session::get('partner_api.role') === $this->role;
    }

    public function user()
    {
        $user = Session::get('partner_api.user') ?: [];

        return collect($user);
    }

    public function token()
    {
        return Session::get('partner_api.token');
    }

    public function hash()
    {
        return Session::get('partner_api.hash');
    }

    public function login(array $credentials)
    {
        if ($this->role === self::ROLE_ADMIN) {
            return $this->loginAdmin($credentials);
        }

        return $this->loginMember($credentials);
    }

    protected function loginMember(array $credentials)
    {
        $user = $this->api->loginMember($credentials);

        return $this->storeLoginSession($user, $credentials);
    }

    protected function loginAdmin(array $credentials)
    {
        $user = $this->api->loginAdmin($credentials);

        return $this->storeLoginSession($user, $credentials);
    }

    protected function storeLoginSession($user, array $credentials)
    {
        if ($user) {
            Session::put('partner_api.role', $this->role);
            Session::put('partner_api.user', $user);

            $string = $credentials['uid'] . '||' . $credentials['passwd'];
            Session::put('partner_api.token', encrypt($string));

            Session::put('partner_api.hash', md5($string));

            return collect($user);
        }

        return null;
    }

    public function logout()
    {
        Session::forget('partner_api.key');
        Session::forget('partner_api.user');
        Session::forget('partner_api.token');
        Session::forget('partner_api.hash');
    }
}

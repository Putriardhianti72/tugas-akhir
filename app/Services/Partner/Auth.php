<?php

namespace App\Services\Partner;

use Illuminate\Support\Facades\Session;

class Auth
{
    public const ROLE_ADMIN = 'admin';
    public const ROLE_MEMBER = 'member';

    protected $role;
    protected static $user;

    public function __construct(string $role)
    {
        $this->role = $role;
    }

    public function check()
    {
        return (boolean) count($this->user());
    }

    public function user()
    {
        if (static::$user) {
            return static::$user;
        }

        $user = Session::get('partner_api.user');

        if ($user) {
            return (static::$user = collect($user));
        }

        return collect();
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
        $user = (new AuthApi())->loginMember($credentials);

        return $this->storeLoginSession($user, $credentials);
    }

    protected function loginAdmin(array $credentials)
    {
        $user = (new AuthApi())->loginAdmin($credentials);

        return $this->storeLoginSession($user, $credentials);
    }

    protected function storeLoginSession($user, array $credentials)
    {
        if ($user) {
            Session::put('partner_api.user', $user);

            $token = encrypt($credentials['uid'] . '||' . $credentials['passwd']);
            Session::put('partner_api.token', $token);

            return collect($user);
        }

        return null;
    }

    public function logout()
    {
        Session::forget('partner_api.user');
        Session::forget('partner_api.token');
    }
}

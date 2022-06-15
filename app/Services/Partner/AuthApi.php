<?php

namespace App\Services\Partner;

use Exception;

class AuthApi extends Api
{
    public function login(array $credentials)
    {
        return $this->loginAdmin($credentials) ?: $this->loginUser($credentials);
    }

    public function loginAdmin(array $credentials)
    {
        $response = $this->execute('POST', 'http://dobel.co.id/restfullapi/data/infoadmin.php', [
            'query' => $credentials,
        ]);

        if ($response['status'] === 'success') {
            return $response['result'];
        }

        if (isset($response['message'])) {
            throw new Exception($response['message']);
        }

        return null;
    }

    public function loginMember(array $credentials)
    {
        $response = $this->execute('POST', 'http://dobel.co.id/restfullapi/data/infomember.php', [
            'query' => $credentials,
        ]);

        if ($response['status'] === 'success') {
            return $response['result'];
        }

        if (isset($response['message'])) {
            throw new Exception($response['message']);
        }

        return null;
    }
}

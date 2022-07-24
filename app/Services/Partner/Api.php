<?php

namespace App\Services\Partner;

use GuzzleHttp\Client;
use Exception;
use Illuminate\Support\Facades\Log;

class Api
{
    protected $config = [
        'headers' => [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
        ],
    ];

    protected function execute($method, $url, array $config = [])
    {
        try {
            $client = new Client();
            $config = array_merge($this->config, $config);

            $response = $client->request($method, $url, $config);

            $body = (string) $response->getBody();
            $jsonBody = json_decode($body, true);

            if ($jsonBody === null && json_last_error() !== JSON_ERROR_NONE) {
                $splittedBody = preg_split("/\r\n|\n|\r/", $body);

                if (count($splittedBody) === 2) {
                    $body = $splittedBody[1];
                    $body = json_decode($body, true);
                }
            } else {
                $body = $jsonBody;
            }

            if (is_array($body) && isset($body['status']) && $body['status'] === 'success') {
                return $body;
            }

            return [
                'status' => 'kosong',
                'message' => 'Username atau password tidak sesuai.',
                'result' => null
            ];
        } catch (Exception $e) {
            Log::error($e);

            return [
                'status' => 'error',
                'message' => 'Terjadi kesalahan pada network server.',
                'result' => null,
            ];
        }

        return [];
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

    public function getProduct($token, $code)
    {
        $token = decrypt($token);
        $user = explode('||', $token);
        $uid = $user[0];
        $passwd = $user[1];

        $response = $this->execute('POST', 'http://dobel.co.id/restfullapi/data/infoproduk.php', [
            'query' => [
                'uid' => $uid,
                'passwd' => $passwd,
                'code' => $code,
            ],
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

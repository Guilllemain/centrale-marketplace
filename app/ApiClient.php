<?php

namespace App;

use App\ApiKey;
use GuzzleHttp\Client;

class ApiClient
{
    private function initClient()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => config('marketplace.base_uri'),
            // You can set any number of default request options.
            'timeout'  => 4.0,
        ]);

        return $client;
    }

    public function authenticate(string $email, string $password): ApiKey
    {
        try {
            $apiKeyData = $this->get(
                'users/authenticate',
                [
                    'auth' => [$email, $password],
                ]
            );
        } catch (ClientException $error) {
            if ($error->getResponse()->getStatusCode() === 401) {
                throw new BadCredentials($error);
            }
            throw $error;
        }

        $apiKey = new ApiKey($apiKeyData);
        $this->setApiKey($apiKey);

        return $apiKey;
    }

    public function setApiKey(?ApiKey $apiKey = null): void
    {
        $this->apiKey = $apiKey;
    }

    public function getApiKey(): ?ApiKey
    {
        return $this->apiKey;
    }

    public function get($endpoint, $options = [])
    {
        return json_decode(
            $this->initClient()
                 ->request('GET', $endpoint, $options)
                 ->getBody()
                 ->getContents(),
            true
        );
    }

    public function post($endpoint, $options = [])
    {
        return json_decode(
            $this->initClient()
                 ->request('POST', $endpoint, $options)
                 ->getBody()
                 ->getContents()
            );
    }
}

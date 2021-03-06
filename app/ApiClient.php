<?php

namespace App;

use App\ApiKey;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\RequestOptions;

class ApiClient
{
    private $apiKey;
    private $applicationToken;
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
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
            $this->rawRequest('GET', $endpoint, $options)
                 ->getBody()
                 ->getContents(),
            true
        );
    }

    public function post($endpoint, $options = [])
    {
        return json_decode(
            $this->rawRequest('POST', $endpoint, $options)
                 ->getBody()
                 ->getContents(),
            true
            );
    }

    public function put($endpoint, $options = [])
    {
        return json_decode(
            $this->rawRequest('PUT', $endpoint, $options)
                 ->getBody()
                 ->getContents()
            );
    }

    public function delete(string $endpoint, array $options = [])
    {
        return json_decode(
            $this->rawRequest('DELETE', $endpoint, $options)
                ->getBody()
                ->getContents()
        );
    }

    public function rawRequest(string $method, $uri, array $options = [])
    {
        try {
            return $this->client->request($method, $uri, $this->addAuth($options));
        } catch (BadResponseException $e) {
            throw $e;
        }
    }

    private function addAuth(array $options): array
    {
        if (session('authenticated')) {
            $options['headers']['Authorization'] = 'token '. session()->get('authenticated')['key'];
        }
        // if ($this->apiKey) {
        //     $options['headers']['Authorization'] = 'token '.$this->apiKey->getKey();
        // }
        if ($this->applicationToken) {
            $options['headers']['Application-Token'] = $this->applicationToken;
        }

        return $options;
    }
}

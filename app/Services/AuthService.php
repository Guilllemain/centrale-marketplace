<?php

namespace App\Services;

use App\ApiClient;

class AuthService
{
    protected $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function authenticateUser($email, $password)
    {
        return $this->client->authenticate($email, $password);
    }
}

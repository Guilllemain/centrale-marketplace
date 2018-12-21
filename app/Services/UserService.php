<?php

namespace App\Services;

use App\ApiClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;

class UserService
{
    protected $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * Register to create a user account.
     *
     * @return int ID of the created user.
     *
     * @throws UserAlreadyExists The email address is already used by a user account.
     */
    public function register(string $email, string $password): int
    {
        try {
            $userData = $this->client->post(
                'users',
                [
                    RequestOptions::FORM_PARAMS => [
                        'email' => $email,
                        'password' => $password,
                        // 'firstName' => $firstName,
                        // 'lastName' => $lastName,
                    ],
                ]
            );
        } catch (ClientException $error) {
            throw $error;
        }

        return $userData->id;
    }
}

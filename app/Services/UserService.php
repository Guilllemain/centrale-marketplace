<?php

namespace App\Services;

use App\ApiClient;
use App\User;
use App\Services\AbstractService;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;

class UserService extends AbstractService
{
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

        return $userData['id'];
    }

    /**
     * Retrieve user ID from session.
     */
    public function getUserIdFromSession()
    {
        return session('authenticated')['id'];
    }

    public function getProfileFromId(int $id): User
    {
        // $this->client->mustBeAuthenticated();
        try {
            $user = new User($this->client->get("users/{$id}"));
        } catch (ClientException $error) {
            if ($error->getResponse()->getStatusCode() === 404) {
                throw "User profile #{$id} not found";
            }
            throw $error;
        }

        return $user;
    }

    /**
     * Update the information of a user profile.
     */
    public function updateUser($id)
    {
        // $this->client->mustBeAuthenticated();

        $this->client->put(
            "users/{$id}",
            [
                RequestOptions::FORM_PARAMS => [
                    'email' => request()->email,
                    'firstName' => request()->firstName,
                    'lastName' => request()->lastName,
                ],
            ]
        );
    }

    /**
     * Update the user's addresses.
     */
    public function updateUserAdresses($id, $address)
    {
        // $this->client->mustBeAuthenticated();
        $this->client->put(
            "users/{$id}/addresses",
            [
                RequestOptions::FORM_PARAMS => [
                    'billing' => $address,
                    'shipping' => $address
                ],
            ]
        );
    }

    /**
     * @param int $userId
     * @param string $newPassword
     */
    public function changePassword(int $userId, string $newPassword)
    {
        // $this->client->mustBeAuthenticated();
        $this->client->put("users/$userId/password", [
            RequestOptions::JSON => [
                'password' => $newPassword,
            ],
        ]);
    }
    
    /**
     * send an email to recover the password
     */
    public function recoverPassword(string $email)
    {
        $data = [
            'email' => $email,
        ];

        $this->client->post(
            'users/password/recover',
            [
                RequestOptions::FORM_PARAMS => $data,
            ]
        );
    }
}

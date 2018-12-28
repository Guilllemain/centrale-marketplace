<?php

namespace App\Services;

use App\ApiClient;
use App\Basket;
use App\Services\AbstractService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;

class BasketService extends AbstractService
{
    private const ID_SESSION_KEY = '_basket_id';
    protected $basket;

    private function create()
    {
        return $this->client->post('basket');
    }

    private function createEmptyBasket()
    {
        $id = $this->create();
        return new Basket(['id' => $id]);
    }

    public function getBasket($basketId)
    {
        //create empty basket if there is no ID
        if (!$basketId) {
            $basketId = $this->getBasketId();
        }
        $response = $this->client->get("basket/{$basketId}");
        $attributes = (array) $response;
        return new Basket($attributes);
    }

    public function sendProductToBasket($declinationId, $quantity)
    {
        return $this->addProductToBasket($this->getBasketId(), $declinationId, $quantity);
    }

    private function addProductToBasket($basketId, $declinationId, $quantity)
    {
        if ($quantity < 1) {
            alert('"quantity" must be greater than 0');
        }

        try {
            $responseData = $this->client->post("basket/{$basketId}/add", [
                RequestOptions::FORM_PARAMS => [
                    'declinationId' => $declinationId,
                    'quantity' => $quantity,
                ],
            ]);
        } catch (ClientException $exception) {
            $code = $exception->getResponse()->getStatusCode();

            if (404 === $code) {
                alert('Basket not found', $exception);
            }

            throw $exception;
        }
        return $responseData['quantity'];
    }

    private function getBasketId()
    {
        $basketId = $this->getCurrentBasketId();
        if ($basketId === null) {
            $this->basket = $this->createEmptyBasket();
            $basketId = $this->basket->id;
            $this->setCurrentBasketId($basketId);
        }
        return $basketId;
    }

    public function updateProductQuantity(string $basketId, $declinationId, int $quantity): int
    {
        if ($quantity < 1) {
            throw '"quantity" must be greater than 0';
        }

        try {
            $responseData = $this->client->post("basket/{$basketId}/modify", [
                RequestOptions::FORM_PARAMS => [
                    'declinationId' => $declinationId,
                    'quantity' => $quantity,
                ],
            ]);
        } catch (ClientException $ex) {
            $code = $ex->getResponse()->getStatusCode();

            if (404 === $code) {
                throw 'Basket not found';
            }

            throw $ex;
        }
        return $responseData['quantity'];
    }

    public function removeProductFromBasket(string $basketId, string $declinationId)
    {
        try {
            $this->client->post("basket/{$basketId}/remove", [
                RequestOptions::FORM_PARAMS => [
                    'declinationId' => $declinationId,
                ],
            ]);
        } catch (ClientException $ex) {
            $code = $ex->getResponse()->getStatusCode();

            if (404 === $code) {
                throw 'Basket not found';
            }

            throw $ex;
        }
    }

    private function getCurrentBasketId()
    {
        return session(self::ID_SESSION_KEY);
    }

    private function setCurrentBasketId($basketId)
    {
        session([self::ID_SESSION_KEY => $basketId]);
    }
}

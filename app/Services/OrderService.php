<?php

namespace App\Services;

use App\Services\AbstractService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;

class OrderService extends AbstractService
{
    /**
     * List the orders of the current user.
     */
    public function getOrders()
    {
        // $this->client->mustBeAuthenticated();
        $orders = $this->client->get('user/orders', []);

        return $orders;
    }
}

<?php

namespace App\Services;

use App\ApiClient;

class ImageService
{
    protected $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function getImage($id)
    {
        return $this->client->get("image/${id}");
    }
}

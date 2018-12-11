<?php

namespace App;

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

    public function get($endpoint, $options = [])
    {
        return json_decode(
            $this->initClient()
                 ->request('GET', $endpoint, $options)
                 ->getBody()
                 ->getContents()
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

<?php

return [
    'http_client' => [
        'base_uri' => env('MARKETPLACE_BASE_URI'),
        'timeout'  => 5.0,
        'connect_timeout' => 3.0,
        'read_timeout' => 5.0,
        'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ],
    ]
];

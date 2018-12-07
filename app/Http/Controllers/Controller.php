<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getCategoriesTree()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://sandbox.wizaplace.com/api/v1/',
            // You can set any number of default request options.
            'timeout'  => 4.0,
        ]);

        $response = $client->request('GET', 'catalog/categories/tree');
        $categories = json_decode($response->getBody()->getContents(), false);

        return $categories;
    }
}

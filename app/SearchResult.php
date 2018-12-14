<?php

namespace App;

use App\ProductSummary;

class SearchResult
{
    private $products;

    public function __construct($searchResults)
    {
        $this->products = array_map(static function (array $product) : ProductSummary {
            return new ProductSummary($product);
        }, $searchResults['results']);
    }

    public function getProducts()
    {
        return $this->products;
    }
}

<?php

namespace App;

use App\ProductSummary;

class SearchResult
{
    private $products;
    private $pagination;
    private $facets;

    public function __construct($searchResults)
    {
        $this->products = array_map(static function (array $product) : ProductSummary {
            return new ProductSummary($product);
        }, $searchResults['results']);
        $this->pagination = $searchResults['pagination'];
        $this->facets = $searchResults['facets'];
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function getPagination()
    {
        return $this->pagination;
    }

    public function getFacets()
    {
        return $this->facets;
    }
}

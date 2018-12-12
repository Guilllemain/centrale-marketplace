<?php

namespace App\Services;

use App\ApiClient;
use App\Category;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class CatalogService
{
    protected $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return an array of all categories as a tree
     */
    public function getCategoriesTree()
    {
        return $this->client->get('catalog/categories/tree');
    }

    /**
     * @return category by id
     */
    public function getCategory($id)
    {
        $category = $this->client->get("catalog/categories/{$id}");

        return new Category($category);
    }

    /**
     * @return an array of all categories
     */
    public function getCategories(): array
    {
        return $this->client->get('catalog/categories');
    }

    /**
     * @return product by id
     */
    public function getProductById($id)
    {
        return $this->client->get("catalog/products/{$id}");
    }

    public function search($query = '', $filters = [])
    {
        $query = [
            'query' => $query,
            'filters' => $filters,
        ];
        return $this->client->get(
            'catalog/search/products',
            [RequestOptions::QUERY => $query]
        );
    }
}

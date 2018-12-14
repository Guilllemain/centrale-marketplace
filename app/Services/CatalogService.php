<?php

namespace App\Services;

use App\ApiClient;
use App\Category;
use App\CategoryTree;
use App\Company;
use App\Product;
use App\SearchResult;
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
        $categoriesTree = $this->client->get('catalog/categories/tree');
        return CategoryTree::buildCollection($categoriesTree);
    }

    /**
     * @return category by id
     */
    public function getCategory(int $id)
    {
        $category = $this->client->get("catalog/categories/{$id}");
        return new Category($category);
    }

    /**
     * @return an array of all categories
     */
    public function getCategories(): array
    {
        $categories = $this->client->get('catalog/categories');
        return array_map(static function ($category) {
            return new Category($category);
        }, $categories);
    }

    /**
     * @return product by id
     */
    public function getProductById($id)
    {
        $product = $this->client->get("catalog/products/{$id}");
        return new Product($product);
    }

    public function search($query = '', $filters = [], $sorting = [], $resultsPerPage = 12)
    {
        $query = [
            'query' => $query,
            'filters' => $filters,
            'sorting' => $sorting,
            'resultsPerPage' => $resultsPerPage,
        ];
        $results = $this->client->get(
            'catalog/search/products',
            [RequestOptions::QUERY => $query]
        );

        return new SearchResult($results);
    }

    public function getCompanyById($id)
    {
        try {
            $response = $this->client->get("catalog/companies/{$id}");
        } catch (ClientException $exception) {
            if ($exception->getResponse()->getStatusCode() === 404) {
                throw new NotFound("Company #{$id} not found.", $exception);
            }

            throw $exception;
        }

        return new Company($response);
    }
}

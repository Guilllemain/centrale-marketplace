<?php

namespace App\Service;

use App\Category;
use GuzzleHttp\Client;

class CatalogService
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

	private function get($endpoint)
	{
		return json_decode(
			$this->initClient()
				 ->request('GET', $endpoint)
				 ->getBody()
				 ->getContents()
			);
	}

	/**
	 * @return an array of all categories as a tree
	 */
	public function getCategoriesTree()
	{
	    return $this->get('catalog/categories/tree');
	}

	/**
	 * @return category by id
	 */
	public function getCategory($id)
    {
        $category = $this->get("catalog/categories/{$id}");

        return new Category($category);
    }

    /**
     * @return an array of all categories
     */
    public function getCategories(): array
    {
        return $this->get('catalog/categories');
    }

    /**
     * @return product by id
     */
    public function getProductById($id)
    {
        return $this->get("catalog/products/{$id}");
    }
}
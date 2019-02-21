<?php

namespace App\Http\Controllers;

use App\Services\CatalogService;
use App\Services\SeoService;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{
    private $catalog;
    private $seoService;

    public function __construct(SeoService $seoService, CatalogService $catalog)
    {
        $this->catalog = $catalog;
        $this->seoService = $seoService;
    }

    public function show($category, $subCategory, $finalCategory, $slug)
    {
        $product = $this->getProductFromSlug($slug);
        if (!$product) {
            throw "Product '${slug}' Not Found";
        }
        return view('product.show', compact('product'));
    }

    protected function getProductFromSlug($slug)
    {
        $slugTarget = $this->seoService->resolveSlug($slug);
        if (is_null($slugTarget)) {
            return null;
        }
        $productId = $slugTarget['id'];

        return $this->catalog->getProductById($productId);
    }
}

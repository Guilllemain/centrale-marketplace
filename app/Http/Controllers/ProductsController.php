<?php

namespace App\Http\Controllers;

use App\Services\CatalogService;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{
    private $catalog;

    public function __construct(CatalogService $catalog)
    {
        $this->catalog = $catalog;
    }

    public function show($category = null, $id)
    {
        $product = $this->catalog->getProductById($id);
        // dd($product);
        return view('product.show', compact('product'));
    }
}

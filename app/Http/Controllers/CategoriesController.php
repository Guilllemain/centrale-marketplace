<?php

namespace App\Http\Controllers;

use App\Services\CatalogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    private $catalog;

    public function __construct(CatalogService $catalog)
    {
        $this->catalog = $catalog;
    }

    public function index()
    {
    }

    public function search(Request $request)
    {
        // $selectedCategoryId = $request->query->getInt("category");
        // $selectedCategory = $selectedCategoryId ? $this->catalog->getCategory($selectedCategoryId) : null;

        // dd($selectedCategoryId);

        return view('search');
    }
}

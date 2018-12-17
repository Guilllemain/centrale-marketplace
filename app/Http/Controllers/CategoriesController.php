<?php

namespace App\Http\Controllers;

use App\Services\CatalogService;
use App\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    private $seoService;
    private $catalog;

    public function __construct(SeoService $seoService, CatalogService $catalog)
    {
        $this->seoService = $seoService;
        $this->catalog = $catalog;
    }

    public function index()
    {
    }

    public function search($category)
    {
        dd($category);
        // $selectedCategoryId = $request->query->getInt("category");
        // $selectedCategory = $selectedCategoryId ? $this->catalog->getCategory($selectedCategoryId) : null;

        // dd($selectedCategoryId);

        return view('search');
    }

    public function show($slug, $subCategory = null, $finalCategory = null, $product = null)
    {
        if ($subCategory) {
            $slug = $subCategory;
            if ($finalCategory) {
                $slug = $finalCategory;
            }
        }

        if (!Cache::has($slug)) {
            $currentCategory = $this->getCategoryFromSlug($slug);
            Cache::add($slug, $currentCategory, 3240);
        }
        $currentCategory = Cache::get($slug);
        
        if (!$currentCategory) {
            throw $this->createNotFoundException("Category '${slug}' Not Found");
        }

        // return json_encode($currentCategory);
        // }

        // $filters = [
        //     'categories' => $currentCategory->getId(),
        // ];

        return view('search', compact('currentCategory'));
    }

    protected function getCategoryFromSlug($slug)
    {
        $slugTarget = $this->seoService->resolveSlug($slug);
        if (is_null($slugTarget)) {
            return null;
        }
        $categoryId = (int) $slugTarget['id'];

        return $this->catalog->getCategory($categoryId);
    }
}

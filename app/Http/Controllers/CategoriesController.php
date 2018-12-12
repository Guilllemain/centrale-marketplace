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

    public function show($slug)
    {
    	$currentCategory = $this->getCategoryFromSlug($slug);
    	dd($currentCategory);
        if (!$currentCategory) {
            throw $this->createNotFoundException("Category '${slug}' Not Found");
        }

        // $filters = [
        //     'categories' => $currentCategory->getId(),
        // ];

        // $userFavoriteIds = $this->favoriteService->getFavoriteIds();

        // return $this->render('@WizaplaceFront/search/search.html.twig', [
        //     'currentCategory' => $currentCategory,
        //     'filters' => $filters,
        //     'userFavoriteIds' => $userFavoriteIds,
        // ]);
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

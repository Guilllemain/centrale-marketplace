<?php

namespace App\Http\Controllers;

use App\Service\CatalogService;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
	private $catalog;

	public function __construct(CatalogService $catalog)
	{
		$this->catalog = $catalog;
	}

	public function index()
	{
		$categories = $this->catalog->getCategoriesTree();

        // dd($categories);
        return view('home', compact('categories'));
	}

	public function search(Request $request)
    {
        $selectedCategoryId = $request->query->getInt("category");
        $selectedCategory = $selectedCategoryId ? $this->catalog->getCategory($selectedCategoryId) : null;

    	// dd($selectedCategoryId);

    	return view('search', compact('selectedCategoryId'));

        // return $this->render('@App/search/search.html.twig', [
        //     'searchQuery' => $request->query->get('q'),
        //     'filters' => $filters,
        //     'selectedCategory' => $selectedCategory,
        //     'userFavoriteIds' => $userFavoriteIds,
        // ]);
    }
}

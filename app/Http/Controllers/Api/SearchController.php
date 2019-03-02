<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CatalogService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(CatalogService $catalog)
    {
        $this->catalog = $catalog;
    }

    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $query = $request->query('query');
            $filters = $request->filters;
            $sorting = $request->sorting;
            $page = $request->page;
            $resultsPerPage = $request->resultsPerPage;
            $results = $this->catalog->search($query, $filters, $sorting, $page, $resultsPerPage);
            return $results;
        }
        $result = 'Résultats de recherche';
        return view('search', compact('result'));
    }

    public function category(Request $request)
    {
        $slug = $request->query->get('slug');
        dd($slug);
    }

    public function searchAlgolia(Request $request)
    {
        return $this->catalog->searchAlgolia($request->query('query'));
    }
}

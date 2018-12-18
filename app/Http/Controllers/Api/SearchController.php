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
            $query = $request->query->get('query');
            $filters = $request->query->get('filters');
            $sorting = $request->query->get('sorting');
            $page = $request->query->get('page');
            $resultsPerPage = $request->query->get('resultsPerPage');
            $results = $this->catalog->search($query, $filters, $sorting, $page, $resultsPerPage);
            return $results;
        }
        return view('search');
    }

    public function category(Request $request)
    {
        $slug = $request->query->get('slug');
        dd($slug);
    }
}

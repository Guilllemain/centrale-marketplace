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
        $query = $request->query->get('query');
        $filters = $request->query->get('filters');
        $results = $this->catalog->search($query, $filters);
        return $results;
        // return view('search');
    }

    public function category(Request $request)
    {
        $slug = $request->query->get('slug');
        dd($slug);
    }
}

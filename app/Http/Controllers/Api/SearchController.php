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
        if ($request->wantsJson()) {
            return json_encode($results);
        }
        return view('search', compact('results'));
    }
}

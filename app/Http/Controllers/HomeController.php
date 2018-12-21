<?php

namespace App\Http\Controllers;

use App\Category;
use App\Services\CatalogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    protected $catalog;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CatalogService $catalog)
    {
        $this->catalog = $catalog;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // session()->flush();
        dd(session());
        if (!Cache::has('latestProducts')) {
            $latestProducts = $this->getLatestProducts()->getProducts();
            Cache::add('latestProducts', $latestProducts, 3240);
        }
        $latestProducts = Cache::get('latestProducts');
        return view('home', compact('latestProducts'));
    }

    private function getLatestProducts(int $maxProductCount = 6)
    {
        if ($maxProductCount === 0) {
            return [];
        }

        return $this->catalog->search('', [], ['createdAt' => 'desc'], '', $maxProductCount);
    }
}

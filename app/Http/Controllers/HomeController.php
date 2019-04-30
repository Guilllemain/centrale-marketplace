<?php

namespace App\Http\Controllers;

use App\Services\CatalogService;
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
        if (request()->wantsJson()) {
            return $this->getLatestProducts();
        }
        if (!Cache::has('latestProducts')) {
            $latestProducts = $this->getLatestProducts()->getProducts();
            Cache::add('latestProducts', $latestProducts, 60 * 60 * 48); // keep cache for a day
        }
        $latestProducts = Cache::get('latestProducts');
        return view('home', compact('latestProducts'));
    }

    private function getLatestProducts(int $maxProductCount = 12)
    {
        if ($maxProductCount === 0) {
            return [];
        }

        return $this->catalog->search('', [], ['createdAt' => 'desc'], '', $maxProductCount);
    }
}

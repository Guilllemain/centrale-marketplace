<?php

namespace App\Http\Controllers;

use App\Services\BasketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BasketController extends Controller
{
    protected $basketService;

    public function __construct(BasketService $basketService)
    {
        $this->basketService = $basketService;
    }

    public function index()
    {
        if (!Cache::has('basket')) {
            $id = session('_basket_id');
            $basket = $this->basketService->getBasket($id);
            Cache::add('basket', $basket, 3240);
        }
        $basket = Cache::get('basket');
        return $basket->toJson();
    }

    public function addProduct(Request $request)
    {
        $declinationId = $request->declinationId;
        $quantity = $request->quantity;

        $this->basketService->sendProductToBasket($declinationId, $quantity);
    }
}

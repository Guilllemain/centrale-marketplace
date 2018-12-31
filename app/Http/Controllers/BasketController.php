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
        $id = session('_basket_id');
        $basket = $this->basketService->getBasket($id);

        if (request()->wantsJson()) {
            return $basket->toJson();
        }

        return view('basket.index', compact('basket'));
    }

    public function addProduct(Request $request)
    {
        $declinationId = $request->declinationId;
        $quantity = $request->quantity;
        $this->basketService->sendProductToBasket($declinationId, $quantity);
    }

    public function updateQuantity(Request $request, $id)
    {
        $declinationId = $request->declinationId;
        $updatedQuantity = $request->item_qty;
        $this->basketService->updateProductQuantity($id, $declinationId, $updatedQuantity);
        return back();
    }

    public function destroy($id, $declinationId)
    {
        $this->basketService->removeProductFromBasket($id, $declinationId);
        return back();
    }

    public function updateShipping(Request $request, $id)
    {
        // dd($request);
        $shippingGroup = [
            $request->shippingGroup => $request->shipping_method_id
        ];
        $this->basketService->selectShippings($id, $shippingGroup);
        return back();
    }

    public function updateAddress()
    {
        return view('basket.addresses');
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\BasketService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BasketController extends Controller
{
    protected $basketService;
    protected $userService;

    public function __construct(BasketService $basketService, UserService $userService)
    {
        $this->userService = $userService;
        $this->basketService = $basketService;
    }

    public function index()
    {
        $id = session('_basket_id');

        if (request()->wantsJson()) {
            if (!$id) {
                return;
            }
        }
        
        $basket = $this->basketService->getBasket($id);

        if (request()->wantsJson()) {
            return $basket->toJson();
        }

        return view('basket.index', compact('basket'));
    }

    public function addProduct(Request $request)
    {
        $currentbasketId = $this->basketService->getCurrentBasketId();
        $declinationId = $request->declinationId;
        $quantity = $request->quantity;
        $this->basketService->sendProductToBasket($declinationId, $quantity);
        
        if (session('authenticated') && !$currentbasketId) {
            $this->basketService->setUserBasketId(
                $this->userService->getUserIdFromSession(),
                $this->basketService->getCurrentBasketId()
            );
        }
        
        return back()->with('flash', 'Ce produit a été ajouté à votre panier');
    }

    public function updateQuantity(Request $request, $id)
    {
        $declinationId = $request->declinationId;
        $updatedQuantity = $request->item_qty;
        $this->basketService->updateProductQuantity($id, $declinationId, $updatedQuantity);
        return back()->with('flash', 'La quantité a bien été modifiée');
    }

    public function destroy($id, $declinationId)
    {
        $this->basketService->removeProductFromBasket($id, $declinationId);
        return back()->with('flash', 'Ce produit a été supprimé de votre panier');
    }

    public function updateShipping(Request $request, $id)
    {
        $shippingGroup = [
            $request->shippingGroup => $request->shipping_method_id
        ];
        $this->basketService->selectShippings($id, $shippingGroup);
        return back()->with('flash', 'Le mode de livraison a été modifié');
        ;
    }

    public function showAddress()
    {
        $id = session('authenticated')['id'];
        $user = $this->userService->getProfileFromId($id);
        // $basketId = session('_basket_id');
        // $payment = $this->basketService->getPayments($basketId);

        return view('basket.addresses', compact('user'));
    }

    public function updateAddress(Request $request, $userId)
    {
        $this->userService->updateUserAdresses($userId, $request->billing_address, $request->billing_address);
        
        return redirect('/checkout');
    }

    public function checkout()
    {
        $basketId = session('_basket_id');
        $payment_types = $this->basketService->getPayments($basketId);
        return view('basket.payment', compact('payment_types'));
    }

    public function turnIntoOrder()
    {
        $basketId = session('_basket_id');
        $result = $this->basketService->checkout($basketId, 1, true, 'http://centrale-marketplace.test/checkout');
    }

    public function payment(Request $request)
    {
        // \Stripe\Stripe::setApiKey("sk_test_gTpJcxuDkfeXDxAZ95zomrvT");

        // $token = $request->token;

        // $account = \Stripe\Account::create([
        //     "country" => "US",
        //     "type" => "custom",
        //     "account_token" => $token,
        // ]);

        dd($account);
    }
}

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
        return back();
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

    public function payment(Request $request)
    {
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_gTpJcxuDkfeXDxAZ95zomrvT");

        $token = $request->token;

        $account = \Stripe\Account::create([
            "country" => "US",
            "type" => "custom",
            "account_token" => $token,
        ]);

        dd($account);
    }
}

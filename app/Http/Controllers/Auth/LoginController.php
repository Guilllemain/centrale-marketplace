<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Services\BasketService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $authService;
    private $basketService;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BasketService $basketService, AuthService $authService)
    {
        $this->middleware('guest')->except('logout');
        $this->authService = $authService;
        $this->basketService = $basketService;
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $email = $request->email;
        $password = $request->password;
        $credentials = $request->only('email', 'password');
        $apiKey = $this->authService->authenticateUser($email, $password);

        if (!$apiKey) {
            return back();
        }

        $request->session()->put('authenticated', ['id' => $apiKey->id, 'key' => $apiKey->apiKey]);

        $userBasketId = $this->basketService->getUserBasketId($apiKey->id);
        $currentBasketId = session('_basket_id');

        //set the current basket ID if the user has none
        if ($currentBasketId && !$userBasketId) {
            $this->basketService->setUserBasketId($apiKey->id, $this->basketService->getCurrentBasketId());
        }

        //retrieve current basket if there is any and merge it with the last user's basket
        if ($currentBasketId && $userBasketId) {
            $this->basketService->mergeBaskets($currentBasketId, $userBasketId);
        }
        
        return redirect()->intended('/')->with('flash', 'Vous êtes maintenant connecté');
        // if ($this->attemptLogin($request)) {
        //     return $this->sendLoginResponse($request);
        // }
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();

        return redirect('/')->with('flash', 'Vous vous êtes déconnecté avec succès');
    }
}

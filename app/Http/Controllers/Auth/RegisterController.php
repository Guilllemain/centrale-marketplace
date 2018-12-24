<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Services\UserService;
use App\Services\AuthService;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
   
    use RegistersUsers;

    protected $userService;
    protected $authService;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService, AuthService $authService)
    {
        $this->userService = $userService;
        $this->middleware('guest');
        $this->authService = $authService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = new User($data);
        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $email = $request->email;
        $password = $request->password;

        $this->userService->register($email, $password);

        $key = $this->authService->authenticateUser($email, $password);

        $user = $this->create([
            'id' => $key->id,
            'apiKey'=> $key->apiKey,
            'email' => $email,
        ]);

        session('authenticated', $user->apiKey);

        // return redirect('/');
        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }
}

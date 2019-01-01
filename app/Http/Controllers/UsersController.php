<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UsersController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show()
    {
        $id = session('authenticated')['id'];
        $user = $this->userService->getProfileFromId($id);
        // dd($user);
        return view('profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if ($request->has('user_passsword')) {
            $request->validate([
                'password' => 'required|min:6|confirmed'
            ]);
            $this->userService->changePassword($id, $request->password);
        }

        if ($request->has('user_details')) {
            $this->userService->updateUser($id);
        }

        return redirect('/');
    }

    public function updateAddress(Request $request, $user)
    {
        dd($request);
        $billing_address = array_filter([
            'title' => $request->billing_title,
            'firstname' => $request->billing_firstName,
            'lastname' => $request->billing_lastName,
            'company' => $request->billing_company,
            'phone' => $request->billing_phone,
            'address' => $request->billing_address,
            'address_2' => $request->billing_address_2,
            'zipcode' => $request->billing_zipcode,
            'city' => $request->billing_city,
            'country' => $request->billing_country
        ]);

        $delivery_address = array_filter([
            'title' => $request->delivery_title,
            'firstname' => $request->delivery_firstName ?: $user->firstName,
            'lastname' => $request->delivery_lastName ?: $user->lastName,
            'company' => $request->delivery_company,
            'phone' => $request->delivery_phone,
            'address' => $request->delivery_address,
            'address_2' => $request->delivery_address_2,
            'zipcode' => $request->delivery_zipcode,
            'city' => $request->delivery_city,
            'country' => $request->delivery_country
        ]);

        $this->userService->updateUserAdresses($user->id, $billing_address, $delivery_address);
        
        return back();
    }
}

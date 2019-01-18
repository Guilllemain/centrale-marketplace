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

        return back()->with('flash', 'Votre profil a bien été modifié');
    }

    public function updateAddress(Request $request, $userId)
    {
        // $billing_address = array_filter([
        //     'title' => $request->billing_title,
        //     'firstname' => $request->billing_firstName,
        //     'lastname' => $request->billing_lastName,
        //     'company' => $request->billing_company,
        //     'phone' => $request->billing_phone,
        //     'address' => $request->billing_address,
        //     'address_2' => $request->billing_address_2,
        //     'zipcode' => $request->billing_zipcode,
        //     'city' => $request->billing_city,
        //     'country' => $request->billing_country
        // ]);

        $this->userService->updateUserAdresses($userId, $request->billing_address, $request->billing_address);
        
        return back()->with('flash', 'Votre adresse a bien été modifiée');
    }

    public function resetPassword()
    {
        return view('auth.passwords.email');
    }

    public function forgotPassword(Request $request)
    {
        $this->userService->recoverPassword($request->email);

        return back()->with('flash', 'Un email vous a été envoyé');
    }
}

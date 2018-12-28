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
}

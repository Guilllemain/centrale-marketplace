<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\OrderService;

class ProfileController extends Controller
{
    private $userService;
    private $orderService;

    public function __construct(UserService $userService, OrderService $orderService)
    {
        $this->userService = $userService;
        $this->orderService = $orderService;
    }

    public function show($userId = null)
    {
        if (!$userId) {
            $userId = session('authenticated')['id'];
        }
        $user = $this->userService->getProfileFromId($userId);
        // dd($user);
        return view('profile.index', compact('user'));
    }

    public function showAddresses($userId)
    {
        $user = $this->userService->getProfileFromId($userId);

        return view('profile.addresses', compact('user'));
    }

    public function showOrders($userId)
    {
        $user = $this->userService->getProfileFromId($userId);
        $orders = $this->orderService->getOrders();
        // dd($orders);
        return view('profile.orders', compact('orders', 'user'));
    }
}

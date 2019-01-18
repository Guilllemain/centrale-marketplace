<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\OrderService;
use App\Services\FavoriteService;

class ProfileController extends Controller
{
    private $userService;
    private $orderService;
    private $favoriteService;

    public function __construct(UserService $userService, OrderService $orderService, FavoriteService $favoriteService)
    {
        $this->userService = $userService;
        $this->orderService = $orderService;
        $this->favoriteService = $favoriteService;
    }

    public function show($userId = null)
    {
        if (!$userId) {
            $userId = session('authenticated')['id'];
        }
        $user = $this->userService->getProfileFromId($userId);
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

    public function showFavorites($userId)
    {
        $user = $this->userService->getProfileFromId($userId);
        $favorites = $this->favoriteService->getAll();

        return view('profile.favorites', compact('favorites', 'user'));
    }
}

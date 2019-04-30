<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\OrderService;
use App\Services\FavoriteService;
use App\Services\MailingListService;

class ProfileController extends Controller
{
    private $userService;
    private $orderService;
    private $favoriteService;
    private $mailService;

    public function __construct(UserService $userService, OrderService $orderService, FavoriteService $favoriteService, MailingListService $mailService)
    {
        $this->userService = $userService;
        $this->orderService = $orderService;
        $this->favoriteService = $favoriteService;
        $this->mailService = $mailService;
    }

    public function show()
    {
        $user = $this->getUser();
        return view('profile.index', compact('user'));
    }

    public function showAddresses()
    {
        $user = $this->getUser();
        return view('profile.addresses', compact('user'));
    }

    public function showOrders()
    {
        $user = $this->getUser();
        $orders = $this->orderService->getOrders();
        return view('profile.orders', compact('orders', 'user'));
    }

    public function showFavorites()
    {
        $user = $this->getUser();
        $favorites = $this->favoriteService->getAll();
        return view('profile.favorites', compact('favorites', 'user'));
    }

    public function showSubscriptions()
    {
        $user = $this->getUser();
        $isSubscribed = $this->mailService->checkSubcription();
        return view('profile.subscriptions', compact('isSubscribed', 'user'));
    }

    protected function getUser()
    {
        $userId = $this->userService->getUserIdFromSession();
        $user = $this->userService->getProfileFromId($userId);
        return $user;
    }
}

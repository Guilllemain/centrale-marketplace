<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FavoriteService;

class FavoritesController extends Controller
{
    protected $favoriteService;

    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    public function addToFavorites(Request $request)
    {
        $this->favoriteService->addDeclinationToUserFavorites($request->declinationId);

        return back();
    }

    public function isFavorited(Request $request)
    {
        // $declinationId = (string)$request->declinationId . '_0';
        return response()->json($this->favoriteService->isInFavorites($request->declinationId));
    }

    public function removeFavorite(Request $request)
    {
        // $declinationId = (string)$request->declinationId . '_0';
        $this->favoriteService->removeDeclinationToUserFavorites($request->declinationId);
    }
}

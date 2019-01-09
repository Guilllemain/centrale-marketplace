<?php

namespace App\Services;

use App\Services\AbstractService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;

class FavoriteService extends AbstractService
{
    /**
     * Return all the products saved as favorites
     */
    public function getAll() : array
    {
        // $this->client->mustBeAuthenticated();
        $results = $this->client->get('user/favorites/declinations', []);

        return array_map(static function (array $favorite) {
            return $favorite;
        }, $results['_embedded']['favorites']);
    }

    /**
     * Check whether a product is in the user's favorites.
     */
    public function isInFavorites($declinationId)
    {
        // $this->client->mustBeAuthenticated();
        $results = $this->client->get('user/favorites/declinations/ids', []);
        $isInFavorites = false;
        if ($results['count'] > 0) {
            foreach ($results['_embedded']['favorites'] as $result) {
                if ($result === (string)$declinationId) {
                    $isInFavorites = true;
                    break;
                }
            }
        }
        return $isInFavorites;
    }

    /**
     * Favorite a product
     */
    public function addDeclinationToUserFavorites($declinationId)
    {
        // $this->client->mustBeAuthenticated();
        try {
            $this->client->post('user/favorites/declinations/'.$declinationId);
        } catch (\Exception $e) {
            // $code = $e->getCode();
            throw $e;
        }
    }

    /**
     * Remove product from favorites
     */
    public function removeDeclinationToUserFavorites($declinationId)
    {
        // $this->client->mustBeAuthenticated();
        $this->client->delete('user/favorites/declinations/'.$declinationId);
    }
}

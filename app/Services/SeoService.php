<?php

namespace App\Services;

use App\ApiClient;

class SeoService
{
    protected $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function resolveSlugs($slugs)
    {
        if (empty($slugs)) {
            return [];
        }

        $slugs = array_map('strval', $slugs);

        $results = $this->client->get('seo/slugs', ['query' => ['slugs' => $slugs]]);
        $results = json_decode(json_encode($results), true);

        return $results;
    }

    /**
     * Retrieves the target of one slug.
     */
    public function resolveSlug(string $slug)
    {
        return $this->resolveSlugs([$slug])[$slug] ?? null;
    }
}

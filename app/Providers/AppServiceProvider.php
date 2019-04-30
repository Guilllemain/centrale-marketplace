<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Illuminate\Support\Facades\Cache;
use Kevinrob\GuzzleCache\Storage\Psr6CacheStorage;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Strategy\PublicCacheStrategy;
use Kevinrob\GuzzleCache\Storage\LaravelCacheStorage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            '*',
            'App\Http\ViewComposers\CategoriesComposer'
        );
        View::composer(
            '*',
            'App\Http\ViewComposers\FooterMenusComposer'
        );
        setLocale(LC_TIME, 'fr_FR');
        \Carbon\Carbon::setLocale('fr');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('GuzzleHttp\Client', function ($app) {
            $config = config('marketplace.http_client');

            $stack = HandlerStack::create();

            // 10 minutes to keep the cache
            // This value will obviously change as you need
            $TTL = 600;

            // Create Folder GuzzleFileCache inside the providen cache folder path
            $requestCacheFolderName = 'GuzzleFileCache';

            // Retrieve the bootstrap folder path of your Laravel Project
            $cacheFolderPath = base_path() . "/bootstrap";
            
            // Instantiate the cache storage: a PSR-6 file system cache with
            // a default lifetime of 10 minutes (60 seconds).
            $cache_storage = new Psr6CacheStorage(
                new FilesystemAdapter(
                    $requestCacheFolderName,
                    $TTL,
                    $cacheFolderPath
                )
            );
            
            // Add this middleware to the top with `push`
            $stack->push(
              new CacheMiddleware(
                new PublicCacheStrategy(
                    $cache_storage,
                    $TTL // the TTL in seconds
                )
              ),
              'cache'
            );

            $config['handler'] = $stack;
            
            // Initialize the client with the config options
            return new Client($config);
        });

        $this->app->extend(CacheMiddleware::class, function ($service) {
            return new GuzzleCacheLoggerDecorator($service);
        });
    }
}

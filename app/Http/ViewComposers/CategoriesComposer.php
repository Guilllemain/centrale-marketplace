<?php

namespace App\Http\ViewComposers;

use App\Service\CatalogService;
use Illuminate\View\View;

class CategoriesComposer
{
    /**
     * The user repository implementation.
     *
     * @var CatalogService
     */
    protected $catalog;

    /**
     * Create a new profile composer.
     *
     * @param  CatalogService  $catalog
     * @return void
     */
    public function __construct(CatalogService $catalog)
    {
        // Dependencies automatically resolved by service container...
        $this->catalog = $catalog;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', $this->catalog->getCategoriesTree());
    }
}
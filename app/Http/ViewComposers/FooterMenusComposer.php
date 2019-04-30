<?php

namespace App\Http\ViewComposers;

use App\Services\CMSService;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class FooterMenusComposer
{
    /**
     * The user repository implementation.
     *
     * @var CMSService
     */
    protected $cms;

    /**
     * Create a new profile composer.
     *
     * @param  CMSService  $cms
     * @return void
     */
    public function __construct(CMSService $cms)
    {
        $this->cms = $cms;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (!Cache::has('footer_menus')) {
            $footer_menus = $this->cms->getFooterMenus();
            Cache::add('footer_menus', $footer_menus, 172800); // cache for 48h (48 * 3600)
        }
        $footer_menus = Cache::get('footer_menus');
        $view->with('footer_menus', $footer_menus);
    }
}

<?php

namespace App\Services;

use App\Services\AbstractService;

class CMSService extends AbstractService
{

    public function getFooterMenus()
    {
        return $this->client->get('cms/menus');
    }
}

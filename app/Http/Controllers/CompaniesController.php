<?php

namespace App\Http\Controllers;

use App\Services\CatalogService;
use App\Services\SeoService;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    protected $seoService;
    protected $catalog;

    public function __construct(SeoService $seoService, CatalogService $catalog)
    {
        $this->seoService = $seoService;
        $this->catalog = $catalog;
    }

    public function show($slug)
    {
        $currentCompany = $this->getCompanyFromSlug($slug);
        return view('search', compact('currentCompany'));
    }

    protected function getCompanyFromSlug($slug)
    {
        $slugTarget = $this->seoService->resolveSlug($slug);
        if (is_null($slugTarget)) {
            return null;
        }
        $companyId = (int) $slugTarget['id'];

        return $this->catalog->getCompanyById($companyId);
    }
}

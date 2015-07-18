<?php

namespace HynMe\ManagementInterface\Http\Controllers;

use Odotmedia\Dashboard\Controllers\BaseDashboardController;
use LaraLeague\MultiTenant\Contracts\WebsiteRepositoryContract;

class WebsiteController extends BaseDashboardController
{
    public function index(WebsiteRepositoryContract $website)
    {
        return view('management-interface::website.index')->with(['websites' => $website->paginated()]);
    }
}
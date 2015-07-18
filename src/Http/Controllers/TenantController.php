<?php

namespace HynMe\ManagementInterface\Http\Controllers;

use Odotmedia\Dashboard\Controllers\BaseDashboardController;
use LaraLeague\MultiTenant\Contracts\TenantRepositoryContract;

class TenantController extends BaseDashboardController
{
    public function index(TenantRepositoryContract $tenant)
    {
        return view('management-interface::tenant.index')->with(['tenants' => $tenant->paginated()]);
    }
}
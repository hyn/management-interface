<?php

namespace HynMe\ManagementInterface\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Laraflock\Dashboard\Controllers\BaseDashboardController;
use Laraflock\MultiTenant\Contracts\TenantRepositoryContract;
use Laraflock\MultiTenant\Validators\TenantValidator;

class TenantController extends BaseDashboardController
{
    /**
     * Shows list of tenants.
     *
     * @param TenantRepositoryContract $tenant
     *
     * @return $this
     */
    public function index(TenantRepositoryContract $tenant)
    {
        return view('management-interface::tenant.index')->with(['tenants' => $tenant->paginated()]);
    }

    /**
     * Shows tenant creation page.
     *
     * @return array|\Illuminate\View\View
     */
    public function create()
    {
        return view('management-interface::tenant.create');
    }

    /**
     * Creates tenant.
     *
     * @param TenantRepositoryContract $tenant
     *
     * @return $this|bool|\HynMe\Framework\Models\AbstractModel|null
     */
    public function store(TenantRepositoryContract $tenant)
    {
        return (new TenantValidator())->catchFormRequest($tenant->newInstance(), redirect()->route('management-interface.tenant.index'));
    }

    /**
     * Loads tenants for select2 fields and such.
     *
     * @param TenantRepositoryContract $tenant
     * @param ResponseFactory          $response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax(TenantRepositoryContract $tenant, ResponseFactory $response)
    {
        return $response->json($tenant->ajaxQuery('name'));
    }
}

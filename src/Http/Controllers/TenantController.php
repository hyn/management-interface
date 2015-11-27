<?php

namespace Hyn\ManagementInterface\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Laraflock\Dashboard\Controllers\BaseDashboardController;
use Hyn\MultiTenant\Contracts\TenantRepositoryContract;
use Hyn\MultiTenant\Validators\TenantValidator;
use Hyn\MultiTenant\Models\Tenant;

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
     * Shows the delete tenant form.
     *
     * @param Tenant $tenant
     * @return \Illuminate\View\View
     */
    public function delete(Tenant $tenant)
    {
        $deleteRoute = route('management-interface.tenant.deleted', $tenant->present()->urlArguments);

        $name = $tenant->present()->name;

        return view('management-interface::layouts.delete', compact('tenant', 'deleteRoute', 'name'));
    }

    /**
     * Deletes the tenant after submit.
     *
     * @param Tenant $tenant
     * @return $this|bool|\Hyn\Framework\Models\AbstractModel|null
     */
    public function deleted(Tenant $tenant)
    {
        return (new TenantValidator())->catchFormRequest($tenant, redirect()->route('management-interface.tenant.index'));
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
     * @return $this|bool|\Hyn\Framework\Models\AbstractModel|null
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

<?php namespace HynMe\ManagementInterface\Controllers;

use HynMe\Framework\Controllers\AbstractController;
use Config, Response;
use Illuminate\Http\Request;
use LaraLeague\MultiTenant\Contracts\TenantRepositoryContract;
use HynMe\ManagementInterface\Form\Generator;
use LaraLeague\MultiTenant\Validators\TenantValidator;

class TenantController extends AbstractController
{
    /**
     * @var TenantRepositoryContract
     */
    protected $tenant;

    /**
     * @param TenantRepositoryContract $tenant
     * @param Request                  $request
     */
    public function __construct(TenantRepositoryContract $tenant, Request $request)
    {
        $this->tenant = $tenant;
        $this->request = $request;

        $this->view_namespace = 'management-interface';
    }



    /**
     * Loads list of websites and shows add form
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->setViewVariable('section_title', trans_choice('management-interface::tenant.tenant',2));


        $form = new Generator($this->tenant->newInstance(), new TenantValidator, [
            'redirect' => redirect()->route('management-interface@tenant@index')
        ]);

        return $this->catchFormRequest(function() {
            $this->setViewVariable('tenants', $this->tenant->paginated());
            return view("{$this->view_namespace}::tenant.index");
        }, $form);
    }

    /**
     * Ajax results
     * @return Response
     */
    public function ajax()
    {
        return Response::json($this->tenant->ajaxQuery('name'));
    }
}
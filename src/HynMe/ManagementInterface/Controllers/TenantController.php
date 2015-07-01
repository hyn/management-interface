<?php namespace HynMe\ManagementInterface\Controllers;

use HynMe\Framework\Controllers\AbstractController;
use Config, Response, Input;
use HynMe\MultiTenant\Contracts\TenantRepositoryContract;
use Illuminate\Http\Request;

class TenantController extends AbstractController
{
    /**
     * @var TenantRepositoryContract
     */
    protected $tenant;

    public function __construct(TenantRepositoryContract $tenant)
    {
        $this->tenant = $tenant;

        $this->view_namespace = Config::get('management-interface.views-namespace');
    }

    public function index()
    {
        $this->setViewVariable('section_title', trans_choice('management-interface::website.website',2));
        $this->setViewVariable('websites', $this->tenant->paginated());


        return view("{$this->view_namespace}::website.index");
    }

    /**
     * Ajax results
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ajax()
    {
        return Response::json($this->tenant->ajaxQuery('name'));
    }
}
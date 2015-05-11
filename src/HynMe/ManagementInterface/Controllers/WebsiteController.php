<?php namespace HynMe\ManagementInterface\Controllers;


use Config;
use Illuminate\Http\Request;

use HynMe\Framework\Controllers\AbstractController;
use HynMe\MultiTenant\Contracts\HostnameRepositoryContract;
use HynMe\MultiTenant\Validators\HostnameValidator;
use HynMe\MultiTenant\Contracts\WebsiteRepositoryContract;
use HynMe\MultiTenant\Validators\WebsiteValidator;

class WebsiteController extends AbstractController
{
    /**
     * @var HostnameRepositoryContract
     */
    protected $hostname;
    /**
     * @var WebsiteRepositoryContract
     */
    protected $website;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param WebsiteRepositoryContract $website
     * @param Request                   $request
     */
    public function __construct(WebsiteRepositoryContract $website, HostnameRepositoryContract $hostname, Request $request)
    {
        $this->request = $request;

        $this->website = $website;

        $this->hostname = $hostname;

        $this->view_namespace = Config::get('management-interface.views-namespace');
    }

    /**
     * Loads list of websites and shows add form
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->setViewVariable('section_title', trans_choice('management-interface::website.website',2));


        return $this->catchFormRequest(function() {
            $this->setViewVariable('websites', $this->website->paginated());
            return view("{$this->view_namespace}::website.index");
        },
            $this->request,
            $this->website->newInstance('website'),
            new WebsiteValidator,
            redirect()->route('management-interface@website@index')
        );
    }

    /**
     * @param \HynMe\MultiTenant\Models\Website $website
     * @param string                            $identifier
     * @return \View
     */
    public function delete($website, $identifier)
    {
        return $this->showConfirmMessage($this->request, $website, redirect()->route('management-interface@website@index'));
    }

    /**
     * @param \HynMe\MultiTenant\Models\Website $website
     * @param string                            $identifier
     * @return \View
     */
    public function read($website, $identifier)
    {

        $hostname = $this->hostname->newInstance('hostname');
        $hostname->tenant_id = $website->tenant_id;
        $hostname->website_id = $website->id;

        return $this->catchFormRequest(function() use ($website, $identifier) {

            $this->setViewVariable('website', $website);
            $this->setViewVariable('section_title', $identifier);
            return view("{$this->view_namespace}::website.read");

        },
            $this->request,
            $hostname,
            new HostnameValidator,
            redirect()->route('management-interface@website@read', $website->present()->urlArguments)
        );


    }
}
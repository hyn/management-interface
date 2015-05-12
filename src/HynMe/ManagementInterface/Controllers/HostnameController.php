<?php namespace HynMe\ManagementInterface\Controllers;

use HynMe\Framework\Controllers\AbstractController;
use Config, Input;
use HynMe\MultiTenant\Contracts\HostnameRepositoryContract;
use HynMe\MultiTenant\Validators\HostnameValidator;
use Illuminate\Http\Request;
use Response;

class HostnameController extends AbstractController
{
    /**
     * @var WebsiteRepositoryContract
     */
    protected $hostname;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param WebsiteRepositoryContract $website
     * @param Request                   $request
     */
    public function __construct(HostnameRepositoryContract $hostname, Request $request)
    {
        $this->request = $request;

        $this->hostname = $hostname;

        $this->view_namespace = Config::get('management-interface.views-namespace');
    }

    /**
     * @param \HynMe\MultiTenant\Models\Hostname $hostname
     * @param string                            $name
     * @return \View
     */
    public function delete($hostname, $name)
    {
        return $this->showConfirmMessage($this->request, $hostname, redirect()->route('management-interface@website@read', $hostname->website->present()->urlArguments));
    }

    /**
     * @param \HynMe\MultiTenant\Models\Hostname $hostname
     * @param string                            $name
     * @return \View
     */
    public function read($hostname, $name)
    {
        $this->setViewVariable('hostname', $hostname);
        $this->setViewVariable('section_title', $name);
        return view("{$this->view_namespace}::hostname.read");
    }

    /**
     * @param $hostname
     * @param $name
     * @return $this|bool|\HynMe\Framework\Models\AbstractModel|null
     */
    public function update($hostname, $name)
    {
        return $this->catchFormRequest(function() use ($hostname, $name)
        {
            $this->setViewVariable('hostname', $hostname);
            $this->setViewVariable('section_title', $name);
            return view("{$this->view_namespace}::hostname.update");
        },
            $this->request,
            $hostname,
            new HostnameValidator(),
            redirect()->route('management-interface@website@read', $hostname->website->present()->urlArguments)
        );
    }

    /**
     * @return mixed
     */
    public function ajax()
    {
        return Response::json($this->hostname->ajaxQuery('hostname'));
    }
}
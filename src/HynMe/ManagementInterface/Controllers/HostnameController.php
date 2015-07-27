<?php namespace HynMe\ManagementInterface\Controllers;

use HynMe\Framework\Controllers\AbstractController;
use Config, Input;
use HynMe\ManagementInterface\Form\Generator;
use LaraLeague\MultiTenant\Contracts\HostnameRepositoryContract;
use LaraLeague\MultiTenant\Validators\HostnameValidator;
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
    }

    /**
     * @param \LaraLeague\MultiTenant\Models\Hostname $hostname
     * @param string                            $name
     * @return \View
     */
    public function delete($hostname, $name)
    {
        $form = new Generator($hostname, new HostnameValidator, [
            'redirect' => redirect()->route('management-interface@website@read', $hostname->website->present()->urlArguments),
            'method' => 'delete'
        ]);

        return $this->showConfirmMessage($hostname, $form);
    }

    /**
     * @param \LaraLeague\MultiTenant\Models\Hostname $hostname
     * @param string                            $name
     * @return \View
     */
    public function read($hostname, $name)
    {
        $this->setViewVariable('hostname', $hostname);
        $this->setViewVariable('section_title', $name);
        return view("management-interface::hostname.read");
    }

    /**
     * @param $hostname
     * @param $name
     * @return $this|bool|\HynMe\Framework\Models\AbstractModel|null
     */
    public function update($hostname, $name)
    {
        $form = new Generator($hostname, new HostnameValidator, [
            'redirect' => redirect()->route('management-interface@website@read', $hostname->website->present()->urlArguments)
        ]);

        return $this->catchFormRequest(function() use ($hostname, $name)
        {
            $this->setViewVariable('hostname', $hostname);
            $this->setViewVariable('section_title', $name);
            return view("management-interface::hostname.update");
        }, $form);
    }

    /**
     * @return mixed
     */
    public function ajax()
    {
        return Response::json($this->hostname->ajaxQuery('hostname'));
    }
}
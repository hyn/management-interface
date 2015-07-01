<?php namespace HynMe\ManagementInterface\Controllers;

use HynMe\ManagementInterface\Form\Generator;
use Illuminate\Http\Request;
use Response;
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

        $this->view_namespace = 'management-interface';
    }

    /**
     * Loads list of websites and shows add form
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->setViewVariable('section_title', trans_choice('management-interface::website.website',2));


        $form = new Generator($this->website->newInstance('website'), new WebsiteValidator, [
            'redirect' => redirect()->route('management-interface@website@index')
        ]);

        return $this->catchFormRequest(function() {
            $this->setViewVariable('websites', $this->website->paginated());
            return view("{$this->view_namespace}::website.index");
        }, $form);
    }

    /**
     * @param \HynMe\MultiTenant\Models\Website $website
     * @param string                            $identifier
     * @return \View
     */
    public function delete($website, $identifier)
    {
        $form = new Generator($website, new WebsiteValidator, [
            'redirect' => redirect()->route('management-interface@website@index'),
            'method' => 'delete'
        ]);

        return $this->showConfirmMessage($website, $form);
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

        $form = new Generator($hostname, new HostnameValidator, [
            'redirect' => redirect()->route('management-interface@website@read', $website->present()->urlArguments)
        ]);

        return $this->catchFormRequest(function() use ($website, $identifier) {

            $this->setViewVariable('website', $website);
            $this->setViewVariable('section_title', $identifier);
            return view("{$this->view_namespace}::website.read");

        }, $form);
    }

    /**
     * Edit a website
     * @param $website
     * @param $identifier
     * @return $this|bool|\HynMe\Framework\Models\AbstractModel|null
     */
    public function update($website, $identifier)
    {
        $form = new Generator($website, new WebsiteValidator, [
            'redirect' => redirect()->route('management-interface@website@read', $website->present()->urlArguments)
        ]);

        return $this->catchFormRequest(function() use ($website, $identifier)
        {
            $this->setViewVariable('website', $website);
            $this->setViewVariable('section_title', $identifier);
            return view("{$this->view_namespace}::website.update");
        }, $form);
    }

    /**
     * Ajax requested results
     * @return mixed
     */
    public function ajax()
    {
        return Response::json($this->website->ajaxQuery('identifier'));
    }

    public function saveConfigurations($website, $identifer)
    {
        $website->touch();
        return redirect()->route('management-interface@website@read', $website->present()->urlArguments);
    }
}
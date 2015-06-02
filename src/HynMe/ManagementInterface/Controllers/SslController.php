<?php namespace HynMe\ManagementInterface\Controllers;


use Config;
use HynMe\Webserver\Contracts\SslRepositoryContract;
use HynMe\Webserver\Generators\Webserver\Nginx;
use Illuminate\Http\Request;
use Response;

use HynMe\Framework\Controllers\AbstractController;
use HynMe\MultiTenant\Contracts\HostnameRepositoryContract;
use HynMe\Webserver\Validators\SslValidator;

class SslController extends AbstractController
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
    public function __construct(SslRepositoryContract $ssl, Request $request)
    {
        $this->ssl = $ssl;
        $this->request = $request;

        $this->view_namespace = Config::get('management-interface.views-namespace');
    }

    /**
     * Loads list of websites and shows add form
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->setViewVariable('section_title', trans_choice('management-interface::ssl.ssl',2));


        return $this->catchFormRequest(function() {
            $this->setViewVariable('certificates', $this->ssl->paginated());
            return view("{$this->view_namespace}::ssl.index");
        },
            $this->request,
            $this->ssl->newInstance(),
            new SslValidator,
            redirect()->route('management-interface@ssl@index')
        );

        return view("{$this->view_namespace}::ssl.index");
    }

    /**
     * @param \HynMe\MultiTenant\Models\Website $website
     * @param string                            $identifier
     * @return \View
     */
    public function delete($ssl, $identifier)
    {
        return $this->showConfirmMessage($this->request, $ssl, redirect()->route('management-interface@ssl@index'));
    }

    /**
     * @param \HynMe\MultiTenant\Models\Website $website
     * @param string                            $identifier
     * @return \View
     */
    public function read($ssl)
    {
        $this->setViewVariable('section_title',trans_choice('management-interface::ssl.ssl',1));

        return $this->catchFormRequest(function() use ($ssl) {
            $this->setViewVariable('certificate', $ssl);
            return view("{$this->view_namespace}::ssl.read");
        },
            $this->request,
            $this->ssl->newInstance(),
            new SslValidator,
            redirect()->route('management-interface@ssl@read', $ssl->present()->urlArguments)
        );
    }

    /**
     * Edit a website
     * @param $website
     * @param $identifier
     * @return $this|bool|\HynMe\Framework\Models\AbstractModel|null
     */
    public function update($website, $identifier)
    {

    }
}
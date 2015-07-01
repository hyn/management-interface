<?php namespace HynMe\ManagementInterface\Controllers;


use Config;
use HynMe\ManagementInterface\Form\Generator;
use HynMe\Webserver\Contracts\SslRepositoryContract;
use Illuminate\Http\Request;

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

        $this->view_namespace = 'management-interface';
    }

    /**
     * Loads list of websites and shows add form
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->setViewVariable('section_title', trans_choice('management-interface::ssl.ssl',2));

        $form = new Generator($this->ssl->newInstance(), new SslValidator, [
            'redirect' => redirect()->route('management-interface@ssl@index')
        ]);

        return $this->catchFormRequest(function() {
            $this->setViewVariable('certificates', $this->ssl->paginated());
            return view("{$this->view_namespace}::ssl.index");
        }, $form);
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

        $form = new Generator($this->ssl->newInstance(), new SslValidator, [
            'redirect' => redirect()->route('management-interface@ssl@read', $ssl->present()->urlArguments)
        ]);

        return $this->catchFormRequest(function() use ($ssl) {
            $this->setViewVariable('certificate', $ssl);
            return view("{$this->view_namespace}::ssl.read");
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

    }
}
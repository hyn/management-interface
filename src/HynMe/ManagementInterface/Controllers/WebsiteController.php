<?php namespace HynMe\ManagementInterface\Controllers;

use HynMe\Framework\Controllers\AbstractController;
use Config;
use HynMe\MultiTenant\Contracts\WebsiteRepositoryContract;

class WebsiteController extends AbstractController
{
    /**
     * @var WebsiteRepositoryContract
     */
    protected $website;

    public function __construct(WebsiteRepositoryContract $website)
    {
        $this->website = $website;

        $this->view_namespace = Config::get('management-interface.views-namespace');
    }

    public function index()
    {
        $this->setViewVariable('section_title', trans_choice('management-interface::website.website',2));
        $this->setViewVariable('websites', $this->website->paginated());
        return view("{$this->view_namespace}::website.index");
    }
}
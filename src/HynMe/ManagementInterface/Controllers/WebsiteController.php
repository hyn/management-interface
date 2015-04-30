<?php namespace HynMe\ManagementInterface\Controllers;

use App\Http\Controllers\Controller;
use Config;
use HynMe\MultiTenant\Contracts\WebsiteRepositoryContract;

class WebsiteController extends Controller
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
        return view("{$this->view_namespace}::website.index");
    }
}
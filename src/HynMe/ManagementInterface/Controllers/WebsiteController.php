<?php namespace HynMe\ManagementInterface\Controllers;

use HynMe\Framework\Controllers\AbstractController;
use Config;
use Illuminate\Http\Request;
use HynMe\MultiTenant\Contracts\WebsiteRepositoryContract;
use HynMe\MultiTenant\Validators\WebsiteValidator;

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

    public function index(Request $request)
    {
        $this->setViewVariable('section_title', trans_choice('management-interface::website.website',2));
        $this->setViewVariable('websites', $this->website->paginated());

        // form request
        $this->catchFormRequest($request, $this->website->newInstance('website'), new WebsiteValidator);

        return view("{$this->view_namespace}::website.index");
    }
}
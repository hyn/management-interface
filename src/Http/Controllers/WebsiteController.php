<?php

namespace Hyn\ManagementInterface\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Laraflock\Dashboard\Controllers\BaseDashboardController;
use Laraflock\MultiTenant\Contracts\WebsiteRepositoryContract;
use Laraflock\MultiTenant\Models\Website;
use Laraflock\MultiTenant\Validators\WebsiteValidator;

class WebsiteController extends BaseDashboardController
{
    /**
     * Loads the overview of websites.
     *
     * @param WebsiteRepositoryContract $website
     *
     * @return $this
     */
    public function index(WebsiteRepositoryContract $website)
    {
        return view('management-interface::website.index')->with(['websites' => $website->paginated()]);
    }

    /**
     * Shows website create page.
     *
     * @return array|\Illuminate\View\View
     */
    public function create()
    {
        return view('management-interface::website.create');
    }

    /**
     * Create the tenant website after submit.
     *
     * @param WebsiteRepositoryContract $website
     *
     * @return $this|bool|\Hyn\Framework\Models\AbstractModel|null
     */
    public function store(WebsiteRepositoryContract $website)
    {
        return (new WebsiteValidator())->catchFormRequest($website->newInstance(), redirect()->route('management-interface.website.index'));
    }

    /**
     * Shows website edit page.
     *
     * @param \Laraflock\MultiTenant\Models\Website $website
     *
     * @return array|\Illuminate\View\View
     */
    public function edit(Website $website)
    {
        return view('management-interface::website.edit', compact('website'));
    }

    /**
     * Updates the website.
     *
     * @param Website $website
     *
     * @return $this|bool|\Hyn\Framework\Models\AbstractModel|null
     */
    public function update(Website $website)
    {
        return (new WebsiteValidator())->catchFormRequest($website, redirect()->route('management-interface.website.index'));
    }

    /**
     * Website view.
     *
     * @param Website $website
     *
     * @return array|\Illuminate\View\View
     */
    public function read(Website $website)
    {
        return view('management-interface::website.view', compact('website'));
    }

    /**
     * @param WebsiteRepositoryContract $website
     * @param ResponseFactory           $response
     *
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function ajax(WebsiteRepositoryContract $website, ResponseFactory $response)
    {
        return $response->json($website->ajaxQuery('identifier'));
    }
}

<?php

namespace Hyn\ManagementInterface\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Laraflock\Dashboard\Controllers\BaseDashboardController;
use Hyn\MultiTenant\Contracts\WebsiteRepositoryContract;
use Hyn\MultiTenant\Models\Website;
use Hyn\MultiTenant\Validators\WebsiteValidator;

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
     * Shows the delete website form.
     *
     * @param Website $website
     * @return \Illuminate\View\View
     */
    public function delete(Website $website)
    {
        $deleteRoute = route('management-interface.website.deleted', $website->present()->urlArguments);

        $name = $website->present()->name;

        return view('management-interface::layouts.delete', compact('website', 'deleteRoute', 'name'));
    }

    /**
     * Deletes the website after submit.
     *
     * @param Website $website
     * @return $this|bool|\Hyn\Framework\Models\AbstractModel|null
     *
     */
    public function deleted(Website $website)
    {
        return (new WebsiteValidator())->catchFormRequest($website, redirect()->route('management-interface.website.index'));
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
     * @param Website $website
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

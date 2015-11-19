<?php

namespace Hyn\ManagementInterface\Http\Controllers;

use Illuminate\Routing\ResponseFactory;
use Laraflock\Dashboard\Controllers\BaseDashboardController;
use Hyn\MultiTenant\Contracts\HostnameRepositoryContract;
use Hyn\MultiTenant\Models\Hostname;
use Hyn\MultiTenant\Models\Website;
use Hyn\MultiTenant\Validators\HostnameValidator;

class HostnameController extends BaseDashboardController
{

    /**
     * @param HostnameRepositoryContract $hostname
     * @return \Illuminate\View\View
     */
    public function index(HostnameRepositoryContract $hostname)
    {
        return view('management-interface::hostname.index')->with(['hostnames' => $hostname->paginated()]);
    }

    /**
     * Shows the delete hostname form.
     *
     * @param Hostname $hostname
     * @return \Illuminate\View\View
     * @throws \Laracasts\Presenter\Exceptions\PresenterException
     */
    public function delete(Hostname $hostname)
    {
        $deleteRoute = route('management-interface.hostname.deleted', $hostname->present()->urlArguments);

        $name = $hostname->present()->name;

        return view('management-interface::layouts.delete', compact('hostname', 'deleteRoute', 'name'));
    }

    /**
     * Deletes the hostname after submit.
     *
     * @param Hostname $hostname
     *
     * @return $this|bool|\Hyn\Framework\Models\AbstractModel|null
     */
    public function deleted(Hostname $hostname)
    {
        return (new HostnameValidator())->catchFormRequest($hostname, redirect()->route('management-interface.website.read', $hostname->website->present()->urlArguments));
    }

    /**
     * Shows the add hostname form.
     *
     * @param Website $website
     * @param $name
     *
     * @return array|\Illuminate\View\View|mixed
     */
    public function add(Website $website, $name)
    {
        return view('management-interface::hostname.create', compact('website'));
    }

    /**
     * @param HostnameRepositoryContract $hostname
     * @param Website                    $website
     * @param $name
     *
     * @throws \Laracasts\Presenter\Exceptions\PresenterException
     *
     * @return $this|bool|\Hyn\Framework\Models\AbstractModel|null
     */
    public function added(HostnameRepositoryContract $hostname, Website $website, $name)
    {
        return (new HostnameValidator())->catchFormRequest($hostname->newInstance(), redirect()->route('management-interface.website.read', $website->present()->urlArguments));
    }

    /**
     * @param HostnameRepositoryContract $hostname
     * @param ResponseFactory            $response
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax(HostnameRepositoryContract $hostname, ResponseFactory $response)
    {
        return $response->json($hostname->ajaxQuery('hostname'));
    }
}

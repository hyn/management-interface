<?php

namespace HynMe\ManagementInterface\Http\Controllers;

use Illuminate\Routing\ResponseFactory;
use Laraflock\Dashboard\Controllers\BaseDashboardController;
use Laraflock\MultiTenant\Contracts\HostnameRepositoryContract;
use Laraflock\MultiTenant\Models\Hostname;
use Laraflock\MultiTenant\Models\Website;
use Laraflock\MultiTenant\Validators\HostnameValidator;

class HostnameController extends BaseDashboardController
{
    public function delete(Hostname $hostname)
    {
        $deleteRoute = route('management-interface.hostname.deleted', $hostname->present()->urlArguments);

        $name = $hostname->present()->name;

        return view('management-interface::layouts.delete', compact('hostname', 'deleteRoute', 'name'));
    }

    /**
     * deletes the hostname after submit.
     *
     * @param Hostname $hostname
     *
     * @return $this|bool|\HynMe\Framework\Models\AbstractModel|null
     */
    public function deleted(Hostname $hostname)
    {
        return (new HostnameValidator())->catchFormRequest($hostname, redirect()->route('management-interface.website.read', $hostname->website->present()->urlArguments));
    }

    /**
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
     * @return $this|bool|\HynMe\Framework\Models\AbstractModel|null
     */
    public function added(HostnameRepositoryContract $hostname, Website $website, $name)
    {
        return (new HostnameValidator())->catchFormRequest($hostname->newInstance(), redirect()->route('management-interface.website.read', $website->present()->urlArguments));
    }

    public function ajax(HostnameRepositoryContract $hostname, ResponseFactory $response)
    {
        return $response->json($hostname->ajaxQuery('hostname'));
    }
}

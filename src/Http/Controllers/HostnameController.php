<?php

namespace HynMe\ManagementInterface\Http\Controllers;

use HynMe\MultiTenant\Models\Website;
use Laraflock\Dashboard\Controllers\BaseDashboardController;
use Laraflock\MultiTenant\Models\Hostname;
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
     * @return array|\Illuminate\View\View|mixed
     */
    public function add(Website $website, $name) {
        return view('management-interface::hostname.create');
    }
}

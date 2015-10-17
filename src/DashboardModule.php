<?php

namespace Hyn\ManagementInterface;

use Hyn\Webserver\Models\SslCertificate;
use Laraflock\Dashboard\Repositories\Module\ModuleInterface;
use Laraflock\MultiTenant\Models\Tenant;
use Laraflock\MultiTenant\Models\Website;

class DashboardModule implements ModuleInterface
{
    /**
     * A user-friendly name for your module.
     *
     * @return string
     */
    public function getName()
    {
        return 'multi-tenancy';
    }

    /**
     * A user-friendly explanation of what your module exactly does.
     *
     * @return string|void
     */
    public function getDescription()
    {
        return 'Unobtrusive multi tenancy for Laravel 5.1 LTS, division between tenant and system of files, routes, vendors, media and database.';
    }

    /**
     * A unique string Id identifying your module.
     *
     * @info can only contain digits, alphabet characters and underscores
     * @info recommended is the package name
     *
     * @return string
     */
    public function getId()
    {
        return 'hyn';
    }

    /**
     * An array containing the necessary menu elements to be generated in the views.
     *
     * @see https://github.com/laraflock/dashboard/wiki
     *
     * @return array
     */
    public function getMenuItems()
    {
        return [
            // website menu links
            trans_choice('management-interface::website.website', 2) => [
                'href'  => null,
                'icon'  => (new Website())->present()->icon,
                'items' => [
                    trans('management-interface::website.all-websites') => [
                        'href' => route('management-interface.website.index'),
                    ],
                    trans('management-interface::website.create-website') => [
                        'href' => route('management-interface.website.create'),
                    ],
                ],
            ],
            // tenant menu links
            trans_choice('management-interface::tenant.tenant', 2) => [
                'href'  => null,
                'icon'  => (new Tenant())->present()->icon,
                'items' => [
                    trans('management-interface::tenant.all-tenants') => [
                        'href' => route('management-interface.tenant.index'),
                    ],
                    trans('management-interface::tenant.create-tenant') => [
                        'href' => route('management-interface.tenant.create'),
                    ],
                ],
            ],
            // certificate menu links
            trans_choice('management-interface::ssl.ssl', 2) => [
                'href'  => null,
                'icon'  => (new SslCertificate())->present()->icon,
                'items' => [
                    trans('management-interface::ssl.all-certificates') => [
                        'href' => route('management-interface.ssl.index'),
                    ],
                    trans('management-interface::ssl.add-certificate') => [
                        'href' => route('management-interface.ssl.add'),
                    ],
                ],
            ],
        ];
    }
}

<?php


namespace HynMe\ManagementInterface;

use Laraflock\Dashboard\Repositories\Module\ModuleInterface;
use Laraflock\MultiTenant\Models\Tenant;
use Laraflock\MultiTenant\Models\Website;

class DashboardModule implements ModuleInterface
{


    /**
     * A user-friendly name for your module
     *
     * @return string
     */
    public function getName()
    {
        return 'multi-tenancy';
    }
    /**
     * A user-friendly explanation of what your module exactly does
     *
     * @return string|void
     */
    public function getDescription()
    {
        // TODO: Implement getDescription() method.
    }

    /**
     * A unique string Id identifying your module
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
     * An array containing the necessary menu elements to be generated in the views
     *
     * @see https://github.com/laraflock/dashboard/wiki
     *
     * @return array
     */
    public function getMenuItems()
    {
        return [
            trans_choice('management-interface::website.website',2) => [
                'href' => null,
                'icon' => (new Website)->present()->icon,
                'items' => [
                    trans('management-interface::website.all-websites') => [
                        'href' => route('management-interface.website.index'),
                    ],
                    trans('management-interface::website.create-website') => [
                        'href' => route('management-interface.website.create')
                    ]
                ]
            ],
            trans_choice('management-interface::tenant.tenant',2) => [
                'href' => null,
                'icon' => (new Tenant)->present()->icon,
                'items' => [
                    trans('management-interface::tenant.all-tenants') => [
                        'href' => route('management-interface.tenant.index'),
                    ],
                    trans('management-interface::tenant.create-tenant') => [
                        'href' => route('management-interface.tenant.create')
                    ]
                ]
            ],
        ];
    }
}
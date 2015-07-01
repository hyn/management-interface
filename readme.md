# HynMe management interface
[![Latest Stable Version](https://poser.pugx.org/hyn-me/management-interface/v/stable)](https://packagist.org/packages/hyn-me/management-interface)
[![License](https://poser.pugx.org/hyn-me/management-interface/license)](https://packagist.org/packages/hyn-me/management-interface)
[![Build Status](https://travis-ci.org/hyn-me/management-interface.svg)](https://travis-ci.org/hyn-me/management-interface)

A management interface for the packages:
- hyn-me/multi-tenant
- hyn-me/webserver
- more.. when they are available

## License required

This package uses the theme ["Material Admin" by CodeCovers](http://themeforest.net/item/material-admin-bootstrap-admin-html5-app/10646222).

Until a different licensing strategy is possible with this developer you are required to buy an appropriate license for this theme.

## Routes

You can use the management-interface package by setting the following routes in your tenant or global `routes.php` file.
  
It is a design choice to give you your own freedom to secure these routes; I suggest you use the [auth middleware filter](http://laravel.com/docs/5.0/authentication#protecting-routes) on the group. 

```php
Route::group(['prefix' => 'management', 'namespace'=>'HynMe\ManagementInterface\Controllers'], function()
{
    /*
     * Dashboard specific routes
     * @uses HynMe\ManagementInterface\Controllers\DashboardController
     */
    Route::any('dashboard', [
        'as' => 'management-interface@dashboard@index',
        'uses' => 'DashboardController@index'
    ]);
    /*
     * Website model binding
     */
    Route::model('website', 'HynMe\MultiTenant\Models\Website');
    /*
     * Website specific routes
     * @uses HynMe\ManagementInterface\Controllers\WebsiteController
     */
    Route::any('websites', [
        'as' => 'management-interface@website@index',
        'uses' => 'WebsiteController@index'
    ]);
    Route::any('website/{website}/{name}', [
        'as' => 'management-interface@website@read',
        'uses' => 'WebsiteController@read'
    ]);
    Route::any('website/{website}/{name}/delete', [
        'as' => 'management-interface@website@delete',
        'uses' => 'WebsiteController@delete'
    ]);
    Route::any('website/{website}/{name}/update', [
        'as' => 'management-interface@website@update',
        'uses' => 'WebsiteController@update'
    ]);
    Route::post('ajax/websites', [
        'as' => 'management-interface@website@ajax',
        'uses' => 'WebsiteController@ajax'
    ]);
    /*
     * Hostname model binding
     */
    Route::model('hostname', 'HynMe\MultiTenant\Models\Hostname');
    /*
     * Hostname specific routes
     * @uses HynMe\ManagementInterface\Controllers\HostnameController
     */
    Route::any('hostname/{hostname}/{name}/delete', [
        'as' => 'management-interface@hostname@delete',
        'uses' => 'HostnameController@delete'
    ]);
    Route::any('hostname/{hostname}/{name}/update', [
        'as' => 'management-interface@hostname@update',
        'uses' => 'HostnameController@update'
    ]);
    Route::post('ajax/hostnames', [
        'as' => 'management-interface@hostname@ajax',
        'uses' => 'HostnameController@ajax'
    ]);
    /*
     * Hostname model binding
     */
    Route::model('tenant', 'HynMe\MultiTenant\Models\Tenant');
    /*
     * Tenant specific routes
     * @uses HynMe\ManagementInterface\Controllers\TenantController
     */
    Route::post('ajax/tenants', [
        'as' => 'management-interface@tenant@ajax',
        'uses' => 'TenantController@ajax'
    ]);

    /*
     * Ssl model binding
     * @requires hyn-me/webserver
     */
    Route::model('ssl', 'HynMe\Webserver\Models\SslCertificate');
    /*
     * Ssl specific routes
     * @uses HynMe\ManagementInterface\Controllers\SslController
     * @requires hyn-me/webserver
     */
    Route::any('ssl', [
        'as' => 'management-interface@ssl@index',
        'uses' => 'SslController@index'
    ]);
});
```

__Note:__ the global `app/Http/routes.php` is included by the `RoutesServiceProvider` and will append the namespace `App\Http\Controllers` to any defined route group or controller routes.
In order to make the management interface still work globally, use the following group definition:

```php
Route::group(['prefix' => 'management', 'namespace'=>'\HynMe\ManagementInterface\Controllers'], function()
```
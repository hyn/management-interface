<?php

namespace Hyn\ManagementInterface\Http\Controllers;

use Hyn\Webserver\Contracts\SslRepositoryContract;
use Hyn\Webserver\Validators\SslValidator;
use Laraflock\Dashboard\Controllers\BaseDashboardController;

class SslController extends BaseDashboardController
{
    /**
     * Listing of SSL certificates.
     *
     * @param SslRepositoryContract $ssl
     * @return $this
     */
    public function index(SslRepositoryContract $ssl)
    {
        return view('management-interface::ssl.index')->with(['certificates' => $ssl->paginated()]);
    }

    /**
     * Shows SSL certificate create page.
     *
     * @return array|\Illuminate\View\View|mixed
     */
    public function add()
    {
        return view('management-interface::ssl.add');
    }

    /**
     * Stores the SSL certificate after saving.
     *
     * @param SslRepositoryContract $ssl
     * @return $this|bool|\Hyn\Framework\Models\AbstractModel|null
     */
    public function store(SslRepositoryContract $ssl)
    {
        return (new SslValidator())->catchFormRequest($ssl->newInstance(), redirect()->route('management-interface.ssl.index'));
    }
}

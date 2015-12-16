<?php

namespace Hyn\ManagementInterface\Http\Controllers;

use Hyn\Webserver\Contracts\SslRepositoryContract;
use Hyn\Webserver\Models\SslCertificate;
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

    /**
     * Shows SSL certificate edit page.
     *
     * @param SslCertificate $certificate
     * @return array|\Illuminate\View\View|mixed
     */
    public function edit(SslCertificate $certificate)
    {
        return view('management-interface::ssl.edit', compact('certificate'));
    }

    /**
     * Updates the SSL certificate after editing.
     *
     * @param SslCertificate $certificate
     * @return $this|bool|\Hyn\Framework\Models\AbstractModel|null
     */
    public function update(SslCertificate $certificate)
    {
        return (new SslValidator())->catchFormRequest($certificate, redirect()->route('management-interface.ssl.index'));
    }

    public function read(SslCertificate $certificate)
    {
    }
}

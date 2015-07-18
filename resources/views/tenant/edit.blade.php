@extends('management-interface::layouts.create')
@section('title', trans('management-interface::website.edit-website'))
@section('page-title', trans_choice('management-interface::website.website',2))
@section('content')
    <div class="box">
        <div class="box-body">


            {!! BootForm::open()->post()->action(route('management-interface.tenant.update')) !!}
            {!! BootForm::text(trans('management-interface::tenant.name'), 'name') !!}
            {!! BootForm::text(trans('management-interface::tenant.email'), 'email') !!}
            {!! BootForm::text(trans('management-interface::tenant.customer_no'), 'customer_no') !!}
            {!! BootForm::checkbox(trans('management-interface::tenant.administrator'), 'administrator')->disabled(true) !!}

            {!! BootForm::select(trans('management-interface::tenant.reseller_id'), 'reseller_id', [
                $tenant->reseller_id => $tenant->reseller_id ? $tenant->reseller->present()->name
            ])->data_ajax_select(route('management-interface.tenant.ajax')) !!}
            {!! BootForm::select(trans('management-interface::tenant.referer_id'), 'referer_id', [
                $tenant->referer_id => $tenant->referer_id ? $tenant->referer->present()->name
            ])->data_ajax_select(route('management-interface.tenant.ajax')) !!}

            {!! BootForm::submit('<i class="fa fa-save fa-fw"></i> Save')->addClass('btn-sm btn-success')->removeClass('btn-default') !!}
            {!! BootForm::close() !!}
        </div>
    </div>
@stop

@extends('management-interface::layouts.create')
@section('title', trans('management-interface::hostname.add-hostname-title'))
@section('page-title', trans_choice('management-interface::hostname.hostname',2))
@section('content')
    <div class="box">
        <div class="box-body">
            {!! BootForm::open()->post()->action(route('management-interface.hostname.added', $website->present()->urlArguments)) !!}
            {!! BootForm::text(trans_choice('management-interface::hostname.hostname',1), 'hostname') !!}
            {!! BootForm::select(trans_choice('management-interface::website.website',1), 'website_id', [])->data_ajax_select(route('management-interface.website.ajax')) !!}
            {!! BootForm::select(trans_choice('management-interface::tenant.tenant',1), 'tenant_id', [])->data_ajax_select(route('management-interface.tenant.ajax')) !!}
            {!! BootForm::checkbox(trans('management-interface::hostname.prefer_https'), 'prefer_https')->helpBlock(trans('management-interface::hostname.prefer_https-help')) !!}
            {!! BootForm::select(trans('management-interface::hostname.redirect_to'), 'redirect_to', [])->data_ajax_select(route('management-interface.hostname.ajax')) !!}
            <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-undo fa-fw"></i> Reset
            </button>
            {!! BootForm::submit('<i class="fa fa-save fa-fw"></i> Save')->addClass('btn-sm btn-success')->removeClass('btn-default') !!}
            {!! BootForm::close() !!}
        </div>
    </div>
@stop

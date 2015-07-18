@extends('management-interface::layouts.create')
@section('title', trans('management-interface::website.edit-website'))
@section('page-title', trans_choice('management-interface::website.website',2))
@section('content')
    <div class="box">
        <div class="box-body">
            {!! BootForm::open()->post()->action(route('management-interface.website.update')) !!}
            {!! BootForm::bind($website) !!}
            {!! BootForm::text(trans('management-interface::website.identifier'), 'identifier') !!}
            {!! BootForm::select(trans_choice('management-interface::tenant.tenant',1), 'tenant_id', [
                $website->tenant_id => $website->tenant->present()->name
            ])->data_ajax_select(route('management-interface.tenant.ajax')) !!}
            {!! BootForm::submit('<i class="fa fa-save fa-fw"></i> Save')->addClass('btn-sm btn-success')->removeClass('btn-default') !!}
            {!! BootForm::close() !!}
        </div>
    </div>
@stop

@extends('management-interface::layouts.create')
@section('title', trans('management-interface::website.create-website'))
@section('page-title', trans_choice('management-interface::website.website',2))
@section('content')
    <div class="box">
        <div class="box-body">
            {!! BootForm::open()->post()->action(route('management-interface.website.store')) !!}
            {!! BootForm::text(trans('management-interface::website.identifier'), 'identifier') !!}
            {!! BootForm::select(trans_choice('management-interface::tenant.tenant',1), 'tenant_id', [])->data_ajax_select(route('management-interface.tenant.ajax')) !!}
            <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-undo fa-fw"></i> Reset
            </button>
            {!! BootForm::submit('<i class="fa fa-save fa-fw"></i> Save')->addClass('btn-sm btn-success')->removeClass('btn-default') !!}
            {!! BootForm::close() !!}
        </div>
    </div>
@stop

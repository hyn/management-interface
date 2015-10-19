@extends('management-interface::layouts.create')
@section('title', trans('management-interface::website.edit-website'))
@section('page-title', trans_choice('management-interface::website.website',2))
@section('content')
    <div class="box">
        <div class="box-body">

            {!! BootForm::open()->post()->action(route('management-interface.ssl.update', $certificate->present()->urlArguments)) !!}

            {!! BootForm::bind($certificate) !!}
            {!! BootForm::textarea(trans_choice('management-interface::ssl.certificate',1), 'certificate') !!}
            {!! BootForm::textarea(trans('management-interface::ssl.authority_bundle'), 'authority_bundle') !!}
            {!! BootForm::textarea(trans('management-interface::ssl.key'), 'key') !!}

            {!! BootForm::select(trans_choice('management-interface::tenant.tenant',1), 'tenant_id', [
                $certificate->tenant_id => $certificate->tenant->present()->name
            ])->data_ajax_select(route('management-interface.tenant.ajax')) !!}

            {!! BootForm::submit('<i class="fa fa-save fa-fw"></i> Save')->addClass('btn-sm btn-success')->removeClass('btn-default') !!}
            {!! BootForm::close() !!}

        </div>
    </div>
@stop

@extends($viewNamespace . '::layouts.master')
@section('page-subtitle', trans('management-interface::action.delete'))

@section('content')

    <div class="box">
        <div class="box-body">
            {!! BootForm::open()->post()->action($deleteRoute) !!}
            {!! BootForm::checkbox(trans('management-interface::generic.i-confirm-deletion-of', ['name' => $name]), 'confirm') !!}
            {!! BootForm::submit('<i class="fa fa-trash-o fa-fw"></i> Delete')->addClass('btn-sm btn-danger')->removeClass('btn-default') !!}
            {!! BootForm::close() !!}
        </div>
    </div>
@stop
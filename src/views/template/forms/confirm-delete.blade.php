@extends('management-interface::template.index')

@section('section_body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {!! $form->open() !!}
                        <p class="alert alert-danger">
                            {{ trans('management-interface::request.confirm-deletion-of', ['name' => $model->present()->name]) }}
                        </p>

                        {!! $form->checkbox('confirm', trans('management-interface::generic.i-confirm-deletion-of', ['name' => $model->present()->name])) !!}
                        @include('management-interface::template.interface.buttons.delete')
                    {!! $form->close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
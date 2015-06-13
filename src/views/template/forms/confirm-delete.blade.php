@extends('management-interface::template.index')

@section('section_body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <p class="alert alert-danger">
                            {{ trans('management-interface::request.confirm-deletion-of', ['name' => $model->present()->name]) }}
                        </p>

                        <div class="form-group{% if errors.has('confirm') %} has-error{% endif %}">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-9">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="confirm" value="1"><span class="checkbox-material"><span class="check"></span></span> {{ trans('management-interface::generic.i-confirm-deletion-of', ['name' => $model->present()->name]) }}
                                    </label>
                                </div>
                                @if($errors->first('confirm'))
                                    <span class="help-block">{{ $errors->first('confirm') }}</span>
                                @endif
                            </div>
                        </div>
                        @include('management-interface::template.interface.buttons.delete')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
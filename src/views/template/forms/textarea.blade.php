@extends('management-interface::template.forms.field')

@section('input')
    <textarea
            name="{{ $name }}"
            id="{{ $name }}"
            class="form-control"
            rows="3"
            placeholder="{{ $placeholder or null }}"
            >
            {!! $model->{$name} or null !!}
    </textarea>
@overwrite


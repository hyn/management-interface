@extends('management-interface::template.forms.field')

@section('input')
    <input
            type="text"
            name="{{ $name }}"
            id="{{ $name }}"
            class="form-control"
            placeholder="{{ $placeholder or null }}"
            value="{{ $model->{$name} or null }}"
            >
@overwrite
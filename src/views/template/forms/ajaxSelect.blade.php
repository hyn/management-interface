@extends('management-interface::template.forms.field')

@section('input')
    <select
            name="{{ $name }}"
            value="{{ $model->{$name} or '' }}"
            type="text"
            id="{{ $name }}"
            class="form-control"
            data-limit="{{ $limit or 1 }}"
            data-ajax-select="{{ $url }}"
            >
        @if($model->{$name})
            <option value="{{ $model->{$name} }}" selected="selected">
            @if(!isset($relation))
                {{ $model->{substr($name, 0, -3)}->present()->name }}
            @else
                {{ $model->{$relation}->present()->name }}
            @endif
            </option>
        @endif
    </select>
@overwrite
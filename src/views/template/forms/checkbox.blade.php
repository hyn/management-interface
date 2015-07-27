@extends('management-interface::template.forms.field')


@section('input')

    <div class="checkbox">
        <label>
            <input type="checkbox" name="{{ $name }}" value="1"><span class="checkbox-material"><span class="check"></span></span> {{ $help or null }}
        </label>
    </div>
@overwrite
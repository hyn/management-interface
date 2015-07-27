@extends('management-interface::template.forms.field')


@section('input')
    <div class="togglebutton">
        <label>
            <input type="checkbox" name="{{ $name }}" value="1"> {{ $help or null }}
        </label>
    </div>
@overwrite
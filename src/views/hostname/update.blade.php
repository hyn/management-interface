@extends('management-interface::template.index')

@section('section_body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body no-padding">
                    @include("management-interface::hostname.forms.update-hostname")
                </div>
            </div>
        </div>
    </div>
@overwrite
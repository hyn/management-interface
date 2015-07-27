@extends('management-interface::template.index')

@section('section_body')
    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body no-padding">
                    @include('management-interface::template.tables.hostnames', ['hostnames' => $certificate->hostnames()->paginate()])
                </div>
            </div>
        </div>
    </div>
    {{--@include('management-interface::hostname.forms.add-hostname')--}}
@endsection
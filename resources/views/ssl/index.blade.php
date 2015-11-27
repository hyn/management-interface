@extends($viewNamespace . '::layouts.master')
@section('title', 'Websites - Dashboard')
@section('page-title', trans_choice('management-interface::website.website',2))
@section('page-subtitle', trans('management-interface::website.all-websites'))
@section('header-extras')
    {{-- Data Table Styles --}}
    <link href="{{ asset('vendor/laraflock/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
@stop
@section('content')
    <div class="box">
        <div class="box-body">
            <table id="websites" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ trans_choice('management-interface::ssl.ssl', 1) }}</th>
                    <th>{{ trans_choice('management-interface::hostname.hostname', 2) }}</th>
                    <th>{{ trans_choice('management-interface::tenant.tenant', 1) }}</th>
                    <th class="datatable-nosort">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($certificates as $certificate)
                    <tr class="">
                        <td class="text-center col-xs-1">
                            <a href="{{ route('management-interface.ssl.read', $certificate->present()->urlArguments) }}">{{ $certificate->id }}</a>
                        </td>
                        <td>{{ $certificate->present()->name }}</td>
                        <td>
                            {{ $certificate->present()->hostnamesSummary }}
                        </td>
                        <td>{{ $certificate->tenant->present()->name }}</td>
                        <td class="text-center col-xs-1">
                            <a href="{{ route('management-interface.ssl.read', $certificate->present()->urlArguments) }}" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('management-interface.ssl.edit', $certificate->present()->urlArguments) }}" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
@section('footer-extras')
    {{-- Data Table Scripts --}}
    <script src="{{ asset('vendor/laraflock/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/laraflock/datatables/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('#websites').dataTable({
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false
                }]
            });
        });
    </script>
@stop
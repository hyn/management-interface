@extends($viewNamespace . '::layouts.master')
@section('title', 'Hostnames - Dashboard')
@section('page-title', trans_choice('management-interface::hostname.hostname',2))
@section('page-subtitle', trans('management-interface::hostname.all-hostnames'))
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
                    <th>{{ trans_choice('management-interface::hostname.hostname', 1) }}</th>
                    <th>{{ trans_choice('management-interface::website.website', 1) }}</th>
                    <th>{{ trans_choice('management-interface::tenant.tenant', 1) }}</th>
                    <th class="datatable-nosort">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($hostnames as $hostname)
                    <tr class="">
                        <td class="text-center col-xs-1">
                            @if($hostname->website)
                            <a href="{{ route('management-interface.website.read', $hostname->website->present()->urlArguments) }}">
                            @endif
                                {{ $hostname->id }}
                            @if($hostname->website)
                                </a>
                            @endif
                        </td>
                        <td>{{ $hostname->present()->name }}</td>
                        <td>
                            @if($hostname->website)
                            <a href="{{ route('management-interface.website.read', $hostname->website->present()->urlArguments) }}">
                                {{ $hostname->website->present()->name }}
                            </a>
                            @else
                            -
                            @endif
                        </td>
                        <td>{{ $hostname->tenant->present()->name }}</td>
                        <td class="text-center col-xs-1">
                            @if($hostname->website)
                            <a href="{{ route('management-interface.website.read', $hostname->website->present()->urlArguments) }}" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
                            @endif
                            <a href="{{ route('management-interface.hostname.delete', $hostname->present()->urlArguments) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
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

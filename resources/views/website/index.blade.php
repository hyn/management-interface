@extends($viewNamespace . '::layouts.master')
@section('title', 'Websites - Dashboard')
@section('page-title', trans_choice('management-interface::website.website',2))
@section('page-subtitle', trans('management-interface::website.all-websites'))
@section('header-extras')
    {{-- Data Table Styles --}}
    <link href="{{ asset('vendor/odotmedia/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
@stop
@section('content')
    <div class="box">
        <div class="box-body">
            <table id="permissions" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ trans_choice('management-interface::website.website', 1) }}</th>
                    <th>{{ trans_choice('management-interface::hostname.hostname', 2) }}</th>
                    <th class="datatable-nosort">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($websites as $website)
                    <tr class="">
                        <td class="text-center col-xs-1">
                            <a href="#">{{ $website->id }}</a>
                        </td>
                        <td>{{ $website->present()->name }}</td>
                        <td>{{ $website->present()->hostnamesSummary }}</td>
                        <td class="text-center col-xs-1">
{{--                            {!! BootForm::open()->delete()->action(route('management-interface::website.delete', ['id' => $website->id])) !!}--}}
                            <a href="{{ route('management-interface.website.edit', $website->present()->urlArguments) }}" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
{{--                            {!! BootForm::submit('<i class="fa fa-trash"></i><span class="sr-only">Delete</span>')->addClass('btn btn-xs btn-danger')->removeClass('btn-default')->data('toggle', 'tooltip')->data('placement', 'top')->title('Delete') !!}--}}
                            {{--{!! BootForm::close() !!}--}}
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
    <script src="{{ asset('vendor/odotmedia/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/odotmedia/datatables/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('#permissions').dataTable({
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false
                }]
            });
        });
    </script>
@stop
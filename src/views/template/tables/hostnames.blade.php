
<div class="table-responsive no-margin">
    <table class="table table-striped no-margin">
        <thead>
        <tr>
            <th></th>
            <th>{{ trans_choice('management-interface::hostname.hostname',1) }}</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($hostnames as $hostname)
            <tr>
                <td>
                    @if($hostname->redirect_to)
                        @include('management-interface::template.interface.icons.redirect')
                    @elseif($hostname->prefer_https)
                        @include('management-interface::template.interface.icons.prefer_https')
                    @endif
                </td>
                <td>
                    {{ $hostname->present()->name }}
                </td>
                <td>

                </td>
                <td class="text-right">
                    @include('management-interface::template.interface.buttons.update', ['size' => 'xs', 'href' => route('management-interface@hostname@update', $hostname->present()->urlArguments)])
                    @include('management-interface::template.interface.buttons.delete', ['size' => 'xs', 'href' => route('management-interface@hostname@delete', $hostname->present()->urlArguments)])
                </td>
            </tr>
        @endforeach
        </tbody>

        <tfoot>
        <tr>
            <td colspan="4" class="text-center">
                @include('management-interface::template.interface.buttons.add', ['pull' => 'right', 'modal' => '#add-hostname-form'])

                {!! $hostnames->render() !!}
            </td>
        </tr>
        </tfoot>
    </table>
</div>
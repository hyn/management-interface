@extends('management-interface::template.index')

@section('section_body')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body no-padding">
                    <div class="table-responsive no-margin">
                        <table class="table table-striped no-margin">
                            <thead>
                            <tr>
                                <th>
                                    @include('management-interface::template.interface.icons.website')
                                    {{ trans_choice('management-interface::website.website',1) }}
                                </th>
                                <th>
                                    @include('management-interface::template.interface.icons.hostname')
                                    {{ trans_choice('management-interface::hostname.hostname',2) }}
                                </th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($websites as $website)
                                <tr>
                                    <td>
                                        <code>{{ $website->id }} {{ $website->present()->name }}</code>
                                    </td>
                                    <td>
                                        {{ $website->present()->hostnamesSummary }}
                                        @if($website->present()->additionalHostnames > 0)
                                            <span class="badge">{{ trans('management-interface::generic.n-more', ['n' => $website->present()->additionalHostnames]) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @include('management-interface::template.interface.buttons.view', [
                                            'size' => 'xs',
                                            'href' => route('management-interface@website@read', $website->present()->urlArguments)
                                        ])
                                        @include('management-interface::template.interface.buttons.update', [
                                            'size' => 'xs',
                                            'href' => route('management-interface@website@update', $website->present()->urlArguments)
                                        ])
                                        @include('management-interface::template.interface.buttons.delete', [
                                            'size' => 'xs',
                                            'href' => route('management-interface@website@delete', $website->present()->urlArguments)
                                        ])
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        {!! $websites->render() !!}
                                    </td>
                                    <td class="text-right">
                                        @include('management-interface::template.interface.buttons.add', [
                                            'modal' => '#add-website-form'
                                        ])
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('management-interface::website.forms.add-website')
@endsection
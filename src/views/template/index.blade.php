<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>
        @if(isset($title))
        {{ $title }}
        @elseif(isset($section_title))
        {{ $section_title }}
        @endif

        &middot; {{ isset($site_title) ? $site_title : 'management interface' }}
    </title>

    <link type="text/css" rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/material.min.css">
    <link type="text/css" rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/ripples.min.css">
    {{--<link type="text/css" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/roboto.min.css">--}}
    <link type='text/css' rel='stylesheet' href='//fonts.googleapis.com/css?family=Roboto:400,700'>

    <!-- plugins -->
    <link type="text/css" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
</head>
<body>
@yield('header')

<div id="base" class="row-fluid">
    @if(isset($section_title))
        <div class="section-header col-md-12">
            <h1 class="text-right">
                {{ $section_title }}
            </h1>
        </div>
    @endif
    <div id="menubar" class="col-md-2">
        <div>
            <div>
                <ul id="main-menu" class="nav nav-pills nav-stacked">
                    @section('menubar_items')
                        <li
                            @if(route('management-interface@dashboard@index') == $_tenant['current_url'])
                            class="active"
                            @endif
                            >
                            <a href="{{ route('management-interface@dashboard@index') }}">
                                <div><i class="fa fa-dashboard"></i></div>
                                <span>{{ trans('management-interface::dashboard.dashboard') }}</span>
                            </a>
                        </li>
                        <li
                            @if(route('management-interface@tenant@index') == $_tenant['current_url'])
                            class="active"
                            @endif
                            >
                            <a href="{{ route('management-interface@tenant@index') }}">
                                <div>@include("management-interface::template.interface.icons.tenant")</div>
                                <span>{{ trans_choice('management-interface::tenant.tenant',2) }}</span>
                            </a>
                        </li>
                        <li
                            @if(route('management-interface@website@index') == $_tenant['current_url'])
                            class="active"
                            @endif
                            >
                            <a href="{{ route('management-interface@website@index') }}">
                                <div>@include("management-interface::template.interface.icons.ssl")</div>
                                <span>{{ trans_choice('management-interface::website.website',2) }}</span>
                            </a>
                        </li>
                        <li
                            @if(route('management-interface@ssl@index') == $_tenant['current_url'])
                            class="active"
                            @endif
                            >
                            <a href="{{ route('management-interface@ssl@index') }}">
                                <div>@include("management-interface::template.interface.icons.ssl")</div>
                                <span>{{ trans_choice('management-interface::ssl.ssl',2) }}</span>
                            </a>
                        </li>
                    @show
                </ul>
                <div class="menubar-foot-panel text-center">
                    @section('menubar_footer')
                        <a href="http://hyn.me/assistance">
                            <i class="fa fa-life-ring"></i>
                            Assistance
                        </a>
                    @endsection
                </div>
            </div>
        </div>
    </div>
    <div id="content" class="col-md-10">
        <section>
            <div class="section-body">
                @yield('section_body')
            </div>
        </section>
    </div>
</div>


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>


<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/material.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/ripples.min.js"></script>

<!-- plugins -->
<script src="//cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

<script src="//hyn.me/media/App.js"></script>
@yield('footer_js_extra')
</body>
</html>
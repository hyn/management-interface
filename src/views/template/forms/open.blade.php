<form class="form-horizontal" role="form" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="{{ $method or 'post' }}">
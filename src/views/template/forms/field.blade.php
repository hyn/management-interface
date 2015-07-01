<div class="form-group @if($errors->has($name)) has-error @endif">
    <div class="col-sm-3">
        @if($label or false)
        <label for="{{ $name }}" class="control-label">
            {{ $label }}
        </label>
        @endif
    </div>
    <div class="col-sm-9">

        @yield('input')

        @foreach($errors->get($name) as $error)
            <span class="help-block">{{ $error }}</span>
        @endforeach
    </div>
</div>
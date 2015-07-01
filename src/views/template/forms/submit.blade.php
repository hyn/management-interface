<button
        type="submit"
        class="btn btn-primary"
        >
        @if($model->exists or false)
            {{ trans('management-interface::action.edit') }}
        @else
            {{ trans('management-interface::action.add') }}
        @endif
</button>
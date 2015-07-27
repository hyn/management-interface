<div class="modal fade" id="add-hostname-form"
@if($errors && $errors->count() > 0)
     data-show="true"
        @endif
        >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="formModalLabel">{{ trans('management-interface::hostname.add-hostname-title') }}</h4>
            </div>

            {!! $form->open() !!}
            <div class="modal-body">
                {!! $form->text('hostname', trans_choice('management-interface::hostname.hostname',1), ['placeholder' => trans('management-interface::hostname.hostname-ex')]) !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('management-interface::action.cancel') }}</button>
                <button type="submit" class="btn btn-primary">{{ trans('management-interface::action.add') }}</button>
            </div>
            {!! $form->close() !!}
        </div>
    </div>
</div>
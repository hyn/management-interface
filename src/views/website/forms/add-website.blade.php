<div class="modal fade" id="add-website-form"
     @if($errors && $errors->count() > 0)
         data-show="true"
     @endif
    >
    <div class="modal-dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="formModalLabel">{{ trans('management-interface::website.add-website-title') }}</h4>
        </div>
        <div class="modal-content">

            {!! $form->open() !!}
                <div class="modal-body">
                    {!! $form->text('identifier', trans('management-interface::website.identifier'), ['placeholder' => trans('management-interface::website.identifier-ex')]) !!}
                    {!! $form->ajaxSelect('tenant_id', trans_choice('management-interface::tenant.tenant',1), ['url' => route('management-interface@tenant@ajax')]) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('management-interface::action.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('management-interface::action.add') }}</button>
                </div>
            {!! $form->close() !!}
        </div>
    </div>
</div>

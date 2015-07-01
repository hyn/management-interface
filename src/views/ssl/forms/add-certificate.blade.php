<div class="modal fade" id="add-certificate-form"
@if($errors && $errors->count() > 0)
     data-show="true"
        @endif
        >
    <div class="modal-dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="formModalLabel">{{ trans('management-interface::ssl.add-ssl-title') }}</h4>
        </div>
        <div class="modal-content">

            {!! $form->open() !!}
            <div class="modal-body">
                {!! $form->ajaxSelect('tenant_id', trans_choice('management-interface::tenant.tenant',1), ['url' => route('management-interface@tenant@ajax')]) !!}
                {!! $form->textarea('certificate', trans_choice('management-interface::ssl.certificate',1)) !!}
                {!! $form->textarea('authority_bundle', trans('management-interface::ssl.authority_bundle')) !!}
                {!! $form->textarea('key', trans('management-interface::ssl.key')) !!}
            </div>
            {!! $form->buttons() !!}
            {!! $form->close() !!}
        </div>
    </div>
</div>
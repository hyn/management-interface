{!! $form->open() !!}

    {!! $form->text('identifier', trans('management-interface::website.identifier'), ['placeholder' => trans('management-interface::website.identifier-ex')]) !!}
    {!! $form->ajaxSelect('tenant_id', trans_choice('management-interface::tenant.tenant',1), ['url' => route('management-interface@tenant@ajax')]) !!}

    {!! $form->buttons() !!}

{!! $form->close() !!}
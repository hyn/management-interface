{!! $form->open() !!}

    {!! $form->text('hostname', trans_choice('management-interface::hostname.hostname',1), ['placeholder'=>trans('management-interface::hostname.hostname-ex')]) !!}
    {!! $form->ajaxSelect('tenant_id', trans_choice('management-interface::tenant.tenant',1), ['url' => route('management-interface@website@ajax')]) !!}

    {!! $form->ajaxSelect('website_id', trans_choice('management-interface::website.website',1), ['url' => route('management-interface@website@ajax')]) !!}
    {!! $form->ajaxSelect('redirect_to', trans('management-interface::hostname.redirect_to'), ['url' => route('management-interface@hostname@ajax'), 'relation' => 'redirectToHostname']) !!}
    {!! $form->ajaxSelect('sub_of', trans('management-interface::hostname.sub_of'), ['url' => route('management-interface@hostname@ajax')]) !!}

    {!! $form->checkbox('prefer_https', trans('management-interface::hostname.prefer_https'), ['help' => trans('management-interface::hostname.prefer_https-help')]) !!}

    {!! $form->buttons() !!}

{!! $form->close() !!}

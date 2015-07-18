@extends($viewNamespace . '::layouts.master')
@section('page-subtitle', trans('management-interface::action.create'))


@section('header-extras')
    <link type="text/css" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
@stop

@section('footer-extras')
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script>
        $('[data_ajax_select]').each(function(i, element)
        {
            var limit = $(element).attr('data-limit'),
                    multiple = limit && limit > 1 || limit == false;
            $(element).select2({
                ajax: {
                    dataType: 'json',
                    minimumInputLength: 1,
                    method: 'post',
                    data: function(params)
                    {
                        return {
                            query: params.term,
                            _token: '{{ csrf_token() }}'
                        };
                    },
                    processResults: function(data, page)
                    {
                        return  {
                            results: data
                        };
                    },
                    url: $(this).attr('data_ajax_select'),
                    multiple: multiple
                }
            });
        });
    </script>
@stop
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/advanced-1.css') }}" rel="stylesheet">
    <link href="{{ asset('css/advanced-2.css') }}" rel="stylesheet">
    <script crossorigin="anonymous" type="application/javascript" src="{{ asset('js/anonymous-1.js') }}"></script>
    <script crossorigin="anonymous" async="async" type="application/javascript" src="{{ asset('js/anonymous-2.js') }}"></script>

    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>

    <!-- Styles -->
    @yield('header')

</head>
<body>
@yield('content')
@include('layouts.footer')
</body>
<script type="text/javascript">

    $(document).ready(function () {

        flashEvent();
        var searchRequest = null;

        $('auto-check input').keyup(function () {
            var autoCheckUrl = $(this).parents('auto-check').attr('src');
            var elt = $(this);
            var input = $(this).val();

            if (searchRequest) {
                searchRequest.abort();
            }

            $(elt)
                .removeClass('is-autocheck-errored')
                .removeClass('is-autocheck-successful')
                .addClass('is-autocheck-loading')
                .parents('auto-check')
                .removeClass('errored')
                .removeClass('successed')
                .addClass('is-loading');

            if (!input) {
                $(elt)
                    .removeClass('is-autocheck-loading')
                    .parents('auto-check')
                    .removeClass('is-loading');
                return;
            }

            searchRequest = ajax(
                autoCheckUrl,
                {input: input},
                function (response) {
                    if (response.data.available) {
                        $(elt)
                            .removeClass('is-autocheck-errored')
                            .removeClass('is-autocheck-loading')
                            .addClass('is-autocheck-successful')
                            .parents('auto-check')
                            .removeClass('errored')
                            .removeClass('errored')
                            .addClass('successed');
                    } else {
                        $(elt)
                            .addClass('is-autocheck-errored')
                            .removeClass('is-autocheck-successful')
                            .removeClass('is-autocheck-loading')
                            .parents('auto-check')
                            .addClass('errored')
                            .removeClass('successed');
                    }
                })
        });
    });

    function flashEvent() {
        $('.flash-close').off();
        $('.flash-close').click(function () {
            $(this).parents('.flash').slideUp().remove();
        });
    }

    function ajax(url, data, success_closure, error_closure) {
        return $.ajax({
            url: url,
            type: 'POST',
            data: data
        })
        .done(success_closure)
        .error(error_closure)
    }

    function message(message, type, container) {
        var div = $('<div>').addClass('flash flash-full flash-' + type);
        var div_container = $('<div>').addClass('container');
        var close_button = $('<button>').addClass('flash-close js-flash-close').attr({type: 'button'});
        var close_svg = $('<svg class="octicon octicon-x" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48L7.48 8z"></path></svg>');

        $(close_button).append(close_svg);
        $(div_container).append(close_button);
        $(div_container).append(message);
        $(div).append(div_container);

        if (!container) {
            container = '#js-flash-container';
        }

        console.log($(container));
        $(container).html('').append(div);
        flashEvent();

        return $(div);
    }
</script>
@yield('scripts')
</html>

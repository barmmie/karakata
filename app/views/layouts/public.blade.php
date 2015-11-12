<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="token" content="{{csrf_token()}}">
    @yield('meta')

    <title>{{Setting::get('site_name', 'Karakata')}} | @yield('title')</title>
    @if(Setting::get('rtl_display', '0')== '0')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/semantic-ui/semantic.min.css')}}">
    @endif

    @if(Setting::get('rtl_display', '0')== '1')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/semantic-ui/semantic.rtl.min.css')}}">
        <style type="text/css">
            html {
                direction: rtl;
            }
        </style>
    @endif

    <link rel="stylesheet" href="{{asset('assets/alertify-js/build/css/alertify.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/alertify-js/build/css/themes/semantic.min.css')}}"/>
    @yield('styles')
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/helper.css')}}"/>

    <style type="text/css">

    </style>

</head>
<body>

@include('partials._header')
<div class="m-t-lg">
    <div class="ui grid main">
        @include('partials._message')
        @yield('content')

    </div>

</div>

@include('partials._footer')

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/semantic-ui/semantic.min.js')}}"></script>
<script src="{{asset('assets/alertify-js/build/alertify.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            cache: false,
            headers: {'X-CSRF-TOKEN': $('meta[name=token]').attr("content")}
        });
        $('.right.menu.open').on("click", function (e) {
            e.preventDefault();
            $('.ui.vertical.navbar.menu').toggle();
        });

        $('.ui.dropdown').dropdown();

        $('.message .close')
                .on('click', function () {
                    $(this)
                            .closest('.message')
                            .transition('fade')
                    ;
                })
        ;
    });
</script>
@yield('scripts')

@if(Auth::guest())
    <script type="text/javascript">
        $(document).ready(function () {
            $('.nag-login').popup();
        });
    </script>
@endif


{{Setting::get('analytics')}}



</body>

</html>

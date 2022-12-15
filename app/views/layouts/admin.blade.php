<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="token" content="{{csrf_token()}}">
    @yield('meta')

    <title>Admin | @yield('title')</title>

    <link rel="stylesheet" type="text/css" href="{{asset('assets/semantic-ui/semantic.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/alertify-js/build/css/alertify.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/alertify-js/build/css/themes/semantic.min.css')}}"/>
    @yield('styles')
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/admin_style.css')}}"/>


</head>
<body id="dash" class="pushable" ontouchstart="" cz-shortcut-listen="true">

<div class="ui vertical inverted sidebar menu left" id="toc">
    @include('partials._admin_sidebar')
</div>

<div class="ui black big launch right attached fixed button">
    <i class="content icon"></i>
    <span class="text">{{trans('words.menu')}}</span>
</div>


<div class="ui fixed inverted main menu">
    <div class="ui container">
        <a class="launch icon item">
            <i class="content icon"></i>
            {{trans('words.menu')}}
        </a>

        <div class="item">
            {{Setting::get('site_name')}}
        </div>

        <div class="right menu">


            <div class="item">
                <div class="ui hidden right aligned search input" id="search">
                    <div class="ui transparent icon input">
                        <input class="prompt" type="text" placeholder="Search...">
                        <i class="inverted search link icon" data-content="Search UI"></i>
                    </div>
                    <div class="results"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="pusher">
    <div class="full height">
        <div class="toc" style="min-height: 1200px;">
            <div class="ui vertical admin-sidebar inverted sticky menu">

                @include('partials._admin_sidebar')
            </div>
        </div>
        <div class="article">

            @include('partials._message')

            @yield('content')
        </div>
    </div>

</div>


<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/semantic-ui/semantic.min.js')}}"></script>
<script src="{{asset('assets/alertify-js/build/alertify.min.js')}}"></script>

<script src="{{asset('assets/js/admin_script.js')}}"></script>


<script type="text/javascript">
    $('.ui.dropdown').dropdown();

    $('.message .close')
            .on('click', function () {
                $(this)
                        .closest('.message')
                        .transition('fade')
                ;
            })
    ;

    $('.confirm-delete').on('click', function (e) {
        return confirm("{{trans('phrases.confirm_delete')}}");
    })
</script>
@yield('scripts')



</body>
</html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="token" content="{{csrf_token()}}">
    @yield('meta')

    <link rel="image_src" type="image/jpeg" href="/images/logo.png">

    <!-- Site Properities -->
    <meta name="generator" content="DocPad v6.78.1">
    <title>Dropdown | Semantic UI</title>

    <meta name="description" content="A dropdown allows a user to select a value from a series of options">
    <meta name="keywords" content="html5, ui, library, framework, javascript">



    <link rel="stylesheet" type="text/css" href="{{asset('assets/semantic-ui/semantic.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/helper.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/admin_style.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/alertify-js/build/css/alertify.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/alertify-js/build/css/themes/semantic.min.css')}}"/>
    @yield('styles')

</head>
<body id="dash" class="pushable" ontouchstart="" cz-shortcut-listen="true">

<div class="ui vertical inverted sidebar menu left" id="toc">
    @include('partials._admin_sidebar')
</div>

<div class="ui black big launch right attached fixed button">
    <i class="content icon"></i>
    <span class="text">Menu</span>
</div>


<div class="ui fixed inverted main menu">
    <div class="ui container">
        <a class="launch icon item">
            <i class="content icon"></i>
            Menu
        </a>

        <div class="item">
            Dropdown
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


            <div class="ui masthead vertical tab segment">
                <div class="ui container">
                    <div class="introduction">

                        <h1 class="ui header">
                            Dropdown

                            <div class="sub header">


                                A dropdown allows a user to select a value from a series of options
                            </div>
                        </h1>


                    </div>

                </div>
            </div>


            @yield('content')
        </div>
    </div>

</div>


<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/semantic-ui/semantic.min.js')}}"></script>
<script src="{{asset('assets/alertify-js/build/alertify.min.js')}}"></script>

<script src="{{asset('assets/js/admin_script.js')}}"></script>

@yield('scripts')

<script type="text/javascript">

    $('.message .close')
            .on('click', function() {
                $(this)
                        .closest('.message')
                        .transition('fade')
                ;
            })
    ;
</script>


</body>
</html>
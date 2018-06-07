<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="description" content="@yield('meta_desc')"/>
    <meta name="keywords" content="@yield('met_keywords')"/>
    <meta name="author" content=""/>
    <link rel="shortcut icon" type="image/png" href="{{url('favicon.png')}}">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <title> {{ getSetting('SITE_TITLE') }} | @yield('title') </title>
    <!-- Bootstrap 3.3.5 -->
{!! Html::style('assets/bootstrap/css/bootstrap.min.css') !!}
<!-- Font Awesome -->
    {!! Html::style('assets/dist/css/font-awesome.min.css') !!}

    {!! Html::style('assets/dist/css/animate.min.css') !!}

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700,800' rel='stylesheet'
          type='text/css'>

    {!! Html::style('assets/dist/css/frontend.css') !!}

        @yield('css')
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- start preloader -->
<div class="preloader">
    <div class="sk-circle">
        <div class="sk-circle1 sk-child"></div>
        <div class="sk-circle2 sk-child"></div>
        <div class="sk-circle3 sk-child"></div>
        <div class="sk-circle4 sk-child"></div>
        <div class="sk-circle5 sk-child"></div>
        <div class="sk-circle6 sk-child"></div>
        <div class="sk-circle7 sk-child"></div>
        <div class="sk-circle8 sk-child"></div>
        <div class="sk-circle9 sk-child"></div>
        <div class="sk-circle10 sk-child"></div>
        <div class="sk-circle11 sk-child"></div>
        <div class="sk-circle12 sk-child"></div>
    </div>
</div>
<!-- end preloader -->

@include('layouts.frontend.includes.header')

@yield('content')
<!-- CONTENT-WRAPPER SECTION END-->
@include('layouts.frontend.includes.footer')
<!-- jQuery 2.1.4 -->
{!! Html::script('assets/plugins/jQuery/jQuery-2.1.4.min.js') !!}
<!-- Bootstrap 3.3.5 -->
{!! Html::script('assets/bootstrap/js/bootstrap.min.js') !!}

{!! Html::script('assets/dist/js/jquery.singlePageNav.min.js') !!}

{!! Html::script('assets/dist/js/wow.min.js') !!}

<script type="text/javascript">
    $(document).ready(function () {
        $('.preloader').fadeOut(1000); // set duration in brackets
    })
</script>
@yield('js')
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
    (function () {
        var widget_id = '0EkWwi32fg';
        var d = document;
        var w = window;

        function l() {
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = '//code.jivosite.com/script/widget/' + widget_id;
            var ss = document.getElementsByTagName('script')[0];
            ss.parentNode.insertBefore(s, ss);
        }

        if (d.readyState == 'complete') {
            l();
        } else {
            if (w.attachEvent) {
                w.attachEvent('onload', l);
            } else {
                w.addEventListener('load', l, false);
            }
        }
    })();</script>
<!-- {/literal} END JIVOSITE CODE -->
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}" />

    <title> {{ getSetting('SITE_TITLE') }} | @yield('title') </title>
    <link rel="shortcut icon"  type="image/png" href="{{url('favicon.png')}}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
{!! Html::style('assets/bootstrap/css/bootstrap.min.css') !!}
<!-- Font Awesome -->
{!! Html::style('assets/dist/css/font-awesome.min.css') !!}
<!-- Select2 -->
{!! Html::style('assets/plugins/select2/select2.min.css') !!}
<!-- Theme style -->
{!! Html::style('assets/dist/css/AdminLTE.min.css') !!}

<!-- Animate.css -->
{!! Html::style('assets/dist/css/animate/animate.min.css') !!}
<!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
{!! Html::style('assets/dist/css/skins/_all-skins.min.css') !!}

{!! Html::style('assets/dist/css/jquery.steps.css') !!}
{!! Html::style('assets/dist/css/bootstrap-select.css') !!}

{!! Html::style('assets/dist/css/custom.css') !!}
@yield('css')
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

@include('layouts.member.subscription.includes.header')

<!-- Content Wrapper. Contains page content -->

    <div id="subscription-app" class="container" style="margin-top: 70px">
        @include('layouts.admin.includes.notifications')
        @yield('content')
    </div><!-- /.content-wrapper -->

    <!-- MESSAGE BOX-->
    <div class="message-box animated fadeIn" id="mb-signout">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                <div class="mb-content">
                    <p>Are you sure you want to log out?</p>
                    <p>Press No if you want to continue work. Press Yes to logout current user.</p>
                </div>
                <div class="mb-footer">
                    <div class="pull-right">
                        <a href="{{ url('logout') }}" class="btn btn-success">Yes</a>
                        <button class="btn btn-default mb-control-close">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MESSAGE BOX-->

</div><!-- ./wrapper -->
{{--<div class="row talk-row">
    <div class="col-xs-12">
        <a class="btn btn-talk">Talk to us</a>
    </div>
</div>--}}
@include('layouts.frontend.includes.footer')
{!! Html::script('assets/dist/js/vue.min.js') !!}
<!-- jQuery 2.1.4 -->
{!! Html::script('assets/plugins/jQuery/jQuery-2.1.4.min.js') !!}
<!-- Bootstrap 3.3.5 -->
{!! Html::script('assets/bootstrap/js/bootstrap.min.js') !!}
<!-- Select2 -->
{!! Html::script('assets/plugins/select2/select2.full.min.js') !!}
<!-- SlimScroll -->
{!! Html::script('assets/plugins/slimScroll/jquery.slimscroll.min.js') !!}
<!-- FastClick -->
{!! Html::script('assets/plugins/fastclick/fastclick.min.js') !!}
<!-- AdminLTE App -->
{!! Html::script('assets/dist/js/app.min.js') !!}
<!-- Noty -->
{!! Html::script('assets/plugins/noty/packaged/jquery.noty.packaged.js') !!}


{!! Html::script('assets/dist/js/jquery.steps.js') !!}
{!! Html::script('assets/dist/js/jquery.validate.js') !!}
{!! Html::script('assets/dist/js/jquery-birthday-picker.js') !!}
{!! Html::script('assets/dist/js/bootstrap-select.js') !!}
{!! Html::script('assets/dist/js/jquery.maskedinput.js') !!}



<!-- custom scripts -->
{!! Html::script('assets/dist/js/custom.js') !!}

@yield('js')

<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
    (function(){ var widget_id = '0EkWwi32fg';var d=document;var w=window;function l(){
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->

</body>
</html>

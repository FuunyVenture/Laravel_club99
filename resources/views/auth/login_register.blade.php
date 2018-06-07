@extends('layouts.frontend.app')

@section('css')
@endsection
@section('content')
<div class="col-xs-12 col-sm-6 lr-container" style="float: none;margin: 0 auto;">
<ul class="nav nav-tabs text-center">
    <li role="presentation" class="active register" style="display: inline-block;"><a data-toggle="tab" href="#signup" data-target="#signup">Sign Up</a></li>
    <li role="presentation" class="register" style="display: inline-block;"><a data-toggle="tab" href="#login" data-target="#login">Login</a></li>
</ul>
<div class="tab-content clearfix">
    <div class="tab-pane fade in active" id="signup">
        @include('auth.register')
    </div>
    <div class="tab-pane fade" id="login">
        @include('auth.login')
    </div>
</div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            var url = document.location.toString();
            if (url.match('#')) {
                $('.nav-tabs a[data-target=#'+url.split('#')[1]+']').tab('show') ;
            }

            $('.header-auth-buttons').on('click', function() {
                $('a[data-target="#' + $(this).data('hashtag') + '"]').parent().siblings().first().removeClass('active');
                $('#' + $(this).data('hashtag')).siblings().first().removeClass('in').removeClass('active');

                // Add new classes for tabs
                $('a[data-target="#' + $(this).data('hashtag') + '"]').parent().addClass('active');
                $('#' + $(this).data('hashtag')).addClass('in').addClass('active');
            });

            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                window.location.hash = e.target.hash;
            });

            $(".show-pass").mousedown(function(){
                $(".passwordfield").attr('type','text');
            }).mouseup(function(){
                $(".passwordfield").attr('type','password');
            }).mouseout(function(){
                $(".passwordfield").attr('type','password');
            });

            var enableLoginForm = function(email, password) {
                if(email.trim() != '' && password.trim() != '')
                    $('#login-form').find('button[type="submit"]').attr('disabled', false);
                else
                    $('#login-form').find('button[type="submit"]').attr('disabled', true);
            };

            $('#login-form').find('[name="email"]').on('keyup', function() {
                enableLoginForm($(this).val(), $('#login-form').find('[name="password"]').val());
            });

            $('#login-form').find('[name="password"]').on('keyup', function() {
                enableLoginForm($('#login-form').find('[name="email"]').val(), $(this).val());
            });
        });
    </script>
@endsection

<div class="row">
    <div class="col-xs-12 col-sm-9" style="margin: 0 auto; float: none;">
        <div class="text-center padding-tb title-register">Login to
            <div style="font-size: 60%">club99.love account</div>
        </div>
        <form id="login-form" class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {!! csrf_field() !!}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                <div class="col-xs-12 col-sm-12">
                    <div class="input-group">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                               placeholder="Email address:" required>
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                <div class="col-xs-10 col-sm-8 passbtn-adjust-width">
                    <input id="passwordfield" type="password" class="form-control passwordfield" name="password"
                           placeholder="Password:" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="btn col-xs-4 show-pass">
                    <span class="glyphicon eye-icon"></span>
                    <span class="show-eye">Show pass</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 col-md-6 text-left remember">
                    <div class="checkbox">
                        <div class="fake-box"></div>
                        <input type="checkbox" name="remember" id="logincheck" class="before-terms">
                        <label for="logincheck" class="size44">Remember Me <br><span
                                    class="invisible">sdg</span></label>
                    </div>
                </div>

                <div class="col-xs-12 col-md-6 text-right">
                    <button disabled type="submit" class="btn btn-register btn-login">
                        Login
                    </button>
                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                </div>
            </div>

        </form>
    </div>
</div>


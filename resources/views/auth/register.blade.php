
    <div class="row">
        <div class="col-xs-12 col-sm-9" style="margin: 0 auto; float: none;">
            <div class="text-center padding-tb title-register" >Join club99.love</div>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('signup_firstname') ? ' has-error' : '' }}">

                    <div class="col-xs-12 col-sm-12">
                        <div class="input-group">
                            <input type="text" class="form-control" name="signup_firstname" value="{{ old('signup_firstname') }}" placeholder="First name:" required>
                        </div>
                        @if ($errors->has('signup_firstname'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('signup_firstname') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('signup_lastname') ? ' has-error' : '' }}">

                    <div class="col-xs-12 col-sm-12">
                        <div class="input-group">
                            <input type="text" class="form-control" name="signup_lastname" value="{{ old('signup_lastname') }}" placeholder="Last name:" required>
                        </div>
                        @if ($errors->has('signup_lastname'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('signup_lastname') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('signup_email') ? ' has-error' : '' }}">

                    <div class="col-xs-12 col-sm-12">
                        <div class="input-group">
                            <input type="email" class="form-control" name="signup_email" value="{{ old('signup_email') }}" placeholder="Email address:" required>
                        </div>
                        @if ($errors->has('signup_email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('signup_email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('signup_password') ? ' has-error' : '' }}">

                    <div class="col-xs-10 col-sm-8 passbtn-adjust-width">
                        <input id="passwordfield" type="password" class="form-control passwordfield" name="signup_password" placeholder="Password:" required>
                        @if ($errors->has('signup_password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('signup_password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="btn col-xs-4 show-pass">
                        <span class="glyphicon eye-icon"></span>
                        <span class="show-eye">Show pass</span>
                    </div>
                </div>

                <div class="form-group text-center">
                    <div class="col-xs-12 col-md-10 col-md-offset-1">
                        <div class="checkbox">
                            <div class="fake-box"></div>
                            <input type="checkbox" id="termscheck" name="terms" checked>
                            <label class="flex" for="termscheck">
                                <span class="before-terms">By signing up, I agree to the Club99love 
                                <br> <a href="{{ url('/terms-of-use') }}" target="_blank" class="terms">Terms of Service</a></span>
                            </label>
                        </div>
                        @if ($errors->has('terms'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('terms') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group text-center">
                    <div class="col-xs-12 col-md-12">
                        <button type="submit" class="btn btn-register">
                            Sign Up
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

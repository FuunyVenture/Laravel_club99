@extends('layouts.frontend.app')

@section('title', 'Forgot Password')

@section('css')

@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">E-Mail Address *</label>

                    <div class="col-md-9">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

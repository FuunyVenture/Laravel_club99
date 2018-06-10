@extends('layouts.frontend.app')

@section('title', 'Contact Us')

@section('css')

@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center padding-tb">Contact Us</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-10 center-content">
                <div class="new-box">
                    <div class="row">
                        <div class="col-xs-12 text-center padding-tb invoice-address">Our customer service is available
                            to
                            assist you. Send a message below or via live chat.
                        </div>
                        <div class="col-xs-12 col-sm-10 col-md-9 col-lg-7 center-content">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/contact-us') }}"
                                  novalidate>
                                {!! csrf_field() !!}


                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="col-xs-12 col-sm-3 control-label register">Email:</label>

                                    <div class="col-xs-12 col-sm-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="email"
                                                   value="{{ old('email') }}">
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                                    <label class="col-xs-12 col-sm-3 control-label register">Subject:</label>

                                    <div class="col-xs-12 col-sm-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="subject"
                                                   value="{{ old('subject') }}">
                                        </div>
                                        @if ($errors->has('subject'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                    <label class="col-xs-12 col-sm-3 control-label register">Message:</label>

                                    <div class="col-xs-12 col-sm-9">
                                        <div class="">
                                            <textarea rows="5" cols="5" class="form-control" name="message">{{ old('message') }}</textarea>
                                        </div>
                                        @if ($errors->has('message'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group" style="float:right;">
                                    <div class="col-xs-12 col-md-8">
                                        <button type="submit" class="btn btn-register">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('form').on('submit', function() {
                $('button[type="submit"]').attr('disabled');
            });
        });
    </script>
@endsection

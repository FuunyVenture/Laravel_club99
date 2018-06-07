@extends('layouts.admin.app')

@section('title', 'Admins')

@section('css')

@endsection


@section('content')
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-xs-12 back"><a href="{{ url('admin/team') }}">
                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a>
            </div>
            <div class="col-md-12">
                <h3 class="page-head-line">Admin details</h3>
            </div>
        </div>
        <div class="row" id="profile-app">
            <div class="col-md-12 profile-form-container">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <label class="col-md-2 control-label" for="textinput">
                                First name
                            </label>
                            <div class="col-md-4 completed-forms">
                                {{$user->firstname or ''}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <label class="col-md-2 control-label" for="textinput">
                                Last name
                            </label>
                            <div class="col-md-4 completed-forms">
                                {{$user->lastname or ''}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <label class="col-md-2 control-label" for="email">
                                Email address
                            </label>
                            <div class="col-md-4 completed-forms">
                                {{$user->email or ''}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


@section('js')
    <!-- iCheck 1.0.1 -->
    {!! Html::script('assets/plugins/iCheck/icheck.min.js') !!}

    {!! Html::script('assets/plugins/validationengine/languages/jquery.validationEngine-en.js') !!}

    {!! Html::script('assets/plugins/validationengine/jquery.validationEngine.js') !!}
    <script type="text/javascript">
        $(document).ready(function () {
            /* Initialize Select2 Elements */
            $(".select2").select2({
                placeholder: "Please Select",
                allowClear: true
            });

            /* Validation Engine init */
            var prefix = 's2id_';
            $("form[id^='validate']").validationEngine('attach', {
                promptPosition: "bottomRight", scroll: false,
                prettySelect: true,
                usePrefix: prefix
            });

            $('form').on('submit', function () {
                $('button[type="submit"]').attr('disabled', true);
            });
        });

    </script>
@endsection

@extends('layouts.admin.app')

@section('title', 'Admins')

@section('css')

@endsection


@section('content')
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-xs-12 back">
                <a href="{{ url('admin/team') }}">
                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a>
            </div>
            <div class="col-md-12">
                <h3 class="page-head-line">
                    @if(isset($user))
                        Edit admin
                    @else
                        Add an admin
                    @endif
                </h3>
            </div>
        </div>
        <div class="row" id="profile-app">
            <div class="col-xs-12 col-centred">
                @if(isset($user))
                    <form action="{{url('/admin/team/'.$user->id)}}" method="POST" novalidate>
                        {{method_field('PUT')}}
                        @else
                            <form action="{{url('/admin/team')}}" method="POST" novalidate>
                                @endif
                                {{csrf_field()}}
                                <div class="form-group">
                                    <div class="col-md-12 profile-form-container">
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <div class="row">
                                                    <label class="col-md-2 control-label" for="textinput">
                                                        First name
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input id="firstname" name="firstname" type="text"
                                                               placeholder="first name"
                                                               class="form-control input-md"
                                                               value="{{old('firstname', isset($user) ? ($user->firstname ? $user->firstname : '') : '')}}">
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
                                                    <div class="col-md-4">
                                                        <input id="lastname" name="lastname" type="text"
                                                               placeholder="last name"
                                                               class="form-control input-md"
                                                               value="{{old('lastname', isset($user) ? ($user->lastname ? $user->lastname : '') : '')}}">
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
                                                    <div class="col-md-4">
                                                        <input id="email" name="email" type="email"
                                                               placeholder="email"
                                                               class="form-control input-md"
                                                               value="{{old('email', isset($user) ? ($user->email ? $user->email : '') : '')}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if(! isset($user))
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <div class="row">
                                                        <label class="col-md-2 control-label" for="password">
                                                            Password
                                                        </label>
                                                        <div class="col-md-4">
                                                            <input id="account_password" name="account_password" type="password"
                                                                   placeholder="password"
                                                                   class="form-control input-md"
                                                                   value="{{old('email', isset($user) ? ($user->password ? $user->password : '') : '')}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <div class="row">
                                                        <label class="col-md-2 control-label" for="password">
                                                            Password confirmation
                                                        </label>
                                                        <div class="col-md-4">
                                                            <input id="account_password_confirmation" name="account_password_confirmation" type="password"
                                                                   placeholder="password"
                                                                   class="form-control input-md"
                                                                   value="{{old('account_password_confirmation')}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row" style="float:right;">
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-danger">
                                                @if(isset($user))
                                                    Edit admin
                                                @else
                                                    Add admin
                                                @endif
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
            </div>
        </div>

    </div><!-- /.content -->
    <!-- Default box -->
    {{--    <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">User Details Form</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                                class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                {!! Form::open(['url' =>  isset($user) ? 'admin/users/'.$user->id  :  'admin/users', 'method' => isset($user) ? 'put' : 'post', 'files' => true, 'class' => 'form-horizontal', 'id'=>'validate']) !!}
                {!! Form::hidden('user_id', isset($user) ? $user->id: null) !!}
                <fieldset>
                    <legend>Account Details</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Name *', ['class' => 'control-label col-md-3']) !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        {!! Form::text('name', old('name', isset($user) ? $user->name: null), ['class' => 'form-control validate[required]', 'placeholder'=>'Name']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', 'Email *', ['class' => 'control-label col-md-3']) !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        {!! Form::email('email', old('email', isset($user) ? $user->email: null), ['class' => 'form-control validate[required,custom[email]]', 'placeholder'=>'Email']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('password', 'Password', ['class' => 'control-label col-md-3']) !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        {!! Form::password('password', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('password_confirmation', 'Confirmation', ['class' => 'control-label col-md-3']) !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        {!! Form::password('password_confirmation', ['class' => isset($user) ? 'form-control validate[equals[password]]': 'form-control validate[required,equals[password]]' ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div><!-- .col-md-6 -->

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('role', 'Role *', ['class' => 'control-label col-md-3']) !!}
                                <div class="col-md-9">
                                    {!! Form::select('role', array_add($roles, '','Please Select'), old('role', isset($user) ? $user->role_id: null), ['class' => 'form-control select2 validate[required]']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('avatar', 'Avatar', ['class' => 'control-label col-md-3']) !!}
                                @if(isset($user) && $user->avatar !="")
                                    <div class="col-md-9">
                                        <img src="{{ asset($user->avatar) }}" width="30%" class="img-circle"
                                             alt="User Avatar"/>
                                    </div>
                                @else
                                    <div class="col-md-9">
                                        <img src="{{ asset('uploads/avatars/avatar.png') }}" width="30%"
                                             class="img-circle" alt="User Avatar"/>
                                    </div>
                                @endif
                                <div class="col-md-7 col-md-offset-5" style="margin-top: 10px;">
                                    <span class="btn  btn-file  btn-primary">Upload Avatar
                                        {!! Form::file('avatar') !!}
                                    </span>
                                </div>
                            </div>
                        </div><!-- .col-md-6 -->
                    </div><!-- .row -->
                </fieldset>
                <fieldset>
                    <legend>Contact Details</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('mobile', 'Mobile', ['class' => 'control-label col-md-3']) !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                        {!! Form::text('mobile', old('mobile', isset($user) ? $user->mobile: null), ['class' => 'form-control', 'placeholder'=>'Mobile']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('job_title', 'Job Title', ['class' => 'control-label col-md-3']) !!}
                                <div class="col-md-9">
                                    {!! Form::select('job_title', array_add($job_titles, '','Please Select'), old('job_title', isset($user) ? $user->job_title: null), ['class' => 'form-control select2']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('package_id', 'Package', ['class' => 'control-label col-md-3']) !!}
                                <div class="col-md-9">
                                    {!! Form::select('package_id', array_add($packages, '','Please Select'), old('package_id', isset($user) && $user->package_id != 0 ? $user->package_id: null), ['class' => 'form-control select2']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('address', 'Address *', ['class' => 'control-label col-md-3']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('address', old('address', isset($user) ? $user->address: null), ['class' => 'form-control validate[required]', 'placeholder'=>'Address']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    {!! Form::submit((isset($user)?'Update': 'Add'). ' User', ['class'=>'btn btn-primary']) !!}
                                </div>
                            </div>
                        </div><!-- .col-md-6 -->
                    </div><!-- .row -->
                </fieldset>
                {!! Form::close() !!}
            </div><!-- /.box-body -->
            <div class="box-footer">
            </div><!-- /.box-footer-->
        </div><!-- /.box -->--}}

@endsection


@section('js')
    <!-- iCheck 1.0.1 -->
    {!! Html::script('assets/plugins/iCheck/icheck.min.js') !!}

    {!! Html::script('assets/plugins/validationengine/languages/jquery.validationEngine-en.js') !!}

    {!! Html::script('assets/plugins/validationengine/jquery.validationEngine.js') !!}
    {!! Html::script('assets/dist/js/jquery-birthday-picker.js') !!}
    <script type="text/javascript">
        $(document).ready(function () {
            /* Initialize Select2 Elements */
            $(".select2").select2({
                placeholder: "Please Select",
                allowClear: true
            });

            /* Validation Engine init */
            var prefix = 's2id_';
            $("form[id^='validate']").validationEngine('attach',
                    {
                        promptPosition: "bottomRight", scroll: false,
                        prettySelect: true,
                        usePrefix: prefix
                    });

            @if((isset($user) && isset($user->home_address) && $user->home_address->state) or old('state'))
            <?php
                $defaultState = '';
                if(isset($user) && isset($user->home_address) && $user->home_address->state)
                    $defaultState = $user->home_address->state;
                else if(old('state'))
                    $defaultState = old('state');
            ?>
                $('.selectpicker#state').selectpicker();
            $('.selectpicker#state').val('{{$defaultState}}');
            $('.selectpicker#state').selectpicker('refresh');
            @endif

            @if((isset($user) && isset($user->home_address) && $user->home_address->country) or old('country'))
            <?php
                $defaultCountry = '';
                if(isset($user) && isset($user->home_address) && $user->home_address->country)
                    $defaultCountry = $user->home_address->country;
                else if(old('country'))
                    $defaultCountry = old('country');
            ?>
                $('.selectpicker#country').selectpicker();
            $('.selectpicker#country').val('{{$defaultCountry}}');
            $('.selectpicker#country').selectpicker('refresh');
            @endif

            @if(old('state'))
                $('select[name="state"]').val('{{old('state')}}');
            $('select[name="state"]').selectpicker('refresh');
            @endif

            @if(old('country'))
                $('select[name="country"]').val('{{old('country')}}');
            $('select[name="country"]').selectpicker('refresh');
            @endif

            @if(old('package_id'))
                $('#package-select').val({{old('package_id')}});
            @endif

            $('#package-cost').html(
                    "$" + $('option:selected', $('#package-select')).attr('cost') + "/" + $('option:selected', $('#package-select')).attr('cost_per')
            );

            $('#package-select').on('change', function () {
                $('#package-cost').html(
                        "$" + $('option:selected', this).attr('cost') + "/" + $('option:selected', this).attr('cost_per')
                );
            });

            $("#birthday").birthdayPicker({
                maxAge: 100,
                minAge: 0,
                maxYear: 2016,
                "dateFormat": "middleEndian",
                "monthFormat": "number",
                "placeholder": true,
                "defaultDate": {!!isset($user) && isset($user->birthday) ? 'Date.parse("' . \Carbon\Carbon::parse($user->birthday)->year . ',' . \Carbon\Carbon::parse($user->birthday)->month . ',' . \Carbon\Carbon::parse($user->birthday)->day . '")' : 'false'!!},
                "sizeClass": "selectpicker"
            });

            $('form').on('submit', function () {
                $('button[type="submit"]').attr('disabled', true);
            });
        });
    </script>
@endsection

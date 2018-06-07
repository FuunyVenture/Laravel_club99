@extends('layouts.admin.app')

@section('title', 'Users')

@section('css')

@endsection


@section('content')
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-xs-12 back"><a href="{{ url('admin/users') }}">
                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a>
            </div>
            <div class="col-md-12">
                <h3 class="page-head-line">Member details</h3>
            </div>
        </div>
        <div class="row" id="profile-app">
            <div class="col-xs-12 col-centred">
                @if(isset($user))
                    <form action="{{url('/admin/users/'.$user->id)}}" method="POST">
                        {{method_field('PUT')}}
                        @else
                            <form action="{{url('/admin/users')}}" method="POST">
                                @endif
                                {{csrf_field()}}
                                <div class="form-group">
                                    <div class="col-md-12 profile-form-container">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <div class="row">
                                                    <label class="col-md-3 control-label" for="textinput">First
                                                        name: </label>
                                                    <div class="col-md-9 completed-forms">
                                                        {{$user->firstname or ''}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="row">
                                                    <label class="col-md-3 control-label" for="textinput">Last
                                                        name: </label>
                                                    <div class="col-md-9 completed-forms">
                                                        {{$user->lastname or ''}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <div class="row">
                                                    <label class="col-md-3 control-label" for="email">Email
                                                        address: </label>
                                                    <div class="col-md-9 completed-forms">
                                                        {{$user->email or ''}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="row">
                                                    <label class="col-md-3 control-label" for="textinput">
                                                        Birthday</label>
                                                    <div class="col-md-9 completed-forms">
                                                        <div id="birthday">{{\Carbon\Carbon::parse($user->birthday)->format('m/d/Y')}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <div class="row">
                                                    <label class="col-md-3 control-label" for="textinput">Home
                                                        number: </label>
                                                    <div class="col-md-9 completed-forms">
                                                        {{$user->home_address->home_number or ''}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="row">
                                                    <label class="col-md-3 control-label" for="textinput">Mobile
                                                        number: </label>
                                                    <div class="col-md-9 completed-forms">
                                                        {{$user->home_address->mobile_number or ''}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <h2>Member's home address</h2>
                                                <div class="col-xs-12">
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <div class="row">
                                                                <label class="col-md-3 control-label"
                                                                       for="textinput">Address: </label>
                                                                <div class="col-md-9 completed-forms">
                                                                    {{$user->home_address->address1 or ''}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <div class="row">
                                                                <div class="col-md-offset-3 col-md-9 completed-forms">
                                                                    {{$user->home_address->address2 or ''}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <div class="row">
                                                                <label class="col-md-3 control-label"
                                                                       for="textinput">City: </label>
                                                                <div class="col-md-9 completed-forms">
                                                                    {{$user->home_address->city or ''}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <div class="row">
                                                                <label class="col-md-3 control-label"
                                                                       for="textinput">State: </label>
                                                                <div class="col-md-9 completed-forms">
                                                                    {{$user->home_address->state or ''}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <div class="row">
                                                                <label class="col-md-3 control-label" for="textinput">Zip
                                                                    code: </label>
                                                                <div class="col-md-9 completed-forms">
                                                                    {{$user->home_address->zip_code or ''}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <div class="row">
                                                                <label class="col-md-3 control-label"
                                                                       for="textinput">Country: </label>
                                                                <div class="col-md-9 completed-forms">
                                                                    {{$user->home_address->country or ''}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="row">
                                                         <div class="col-md-3 ">
                                                             <button type="submit" class="btn btn-danger">Add member</button>
                                                         </div>
                                                     </div>--}}
                                                </div>
                                            </div>
                                            @if(isset($user->subscription) && $user->subscription->status == 'pending')
                                                <div class="col-xs-12 col-md-6">
                                                    <h2>Subscription details</h2>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <div class="row">
                                                                <label class="col-md-3 control-label"
                                                                       for="textinput">Name: </label>
                                                                <div class="col-md-9 completed-forms">
                                                                    {{$user->subscription->package->name or ''}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <div class="row">
                                                                <label class="col-md-3 control-label"
                                                                       for="textinput">Cost: </label>
                                                                <div class="col-md-9 completed-forms">
                                                                    {{--{{$user->subscription->package->cost or ''}}--}}
                                                                    ${{$user->subscription->package->cost}}/{{$user->subscription->package->cost_per}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <div class="row">
                                                                <label class="col-md-3 control-label"
                                                                       for="textinput">Receipt code: </label>
                                                                <div class="col-md-9 completed-forms">
                                                                    {{$user->subscription->store_payment->code}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
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

            $('form').on('submit', function() {
                $('button[type="submit"]').attr('disabled', true);
            });
        });

    </script>
@endsection

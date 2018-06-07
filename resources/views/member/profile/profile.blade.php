@extends('layouts.member.app')

@section('title', 'Profile')

@section('css')
    <style type="text/css">
        .margin-bottom {
            margin-bottom: 5px;
        }
    </style>
@endsection
{{--open section--}}
@section('content')
    <div class="content">
        {{--content header--}}
        <div class="page-head-line">My profile</div>
        {{--end content header--}}
        {{--main content--}}
        <div id="profile-app">
            <div class="col-xs-12">
                <div class="row">
                    {{--change picture--}}
                    <div class="profile-image-group text-center">
                        <form action="{{url('/member/profile/update-avatar')}}" method="POST"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                @if(isset($user) && $user->avatar !="")    
                                <div class="profile-image">
                                    <img src="{{ asset($user->avatar) }}" width="100%" class=""
                                         alt="User Avatar"/>
                                </div>
                                @else
                                <div class="profile-image">
                                    <img src="{{ asset('uploads/avatars/profile.svg') }}" width="100%"
                                         class="" alt="User Avatar"/>
                                </div>
                                @endif
                                <div class="btn btn-file btn-primary">Change picture
                                    {!! Form::file('avatar') !!}
                                </div>

                            </div>
                        </form>
                    </div>
                    {{--end change picture--}}
                    {{--profile details--}}
                    <div class="form-group">
                        <div class="profile-col-right pull-right profile-form-container">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="row">
                                        <label class="col-md-3 control-label" for="textinput">First name: </label>
                                        <b class="col-md-9 completed-forms">
                                            {{ $user->firstname }}
                                        </b>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="row">
                                        <label class="col-md-3 control-label" for="textinput">Last name: </label>
                                        <b class="col-md-9 completed-forms">
                                            {{ $user->lastname }}
                                        </b>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="row">
                                        <label class="col-md-3 control-label" for="email">Email address: </label>
                                        <b class="col-md-9 completed-forms">
                                            {{ $user->email }}
                                        </b>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="row">
                                        <label class="col-md-3 control-label" for="textinput">Your
                                            birthday: </label>
                                        <div class="col-md-9 completed-forms">
                                            <b id="birthday">{{\Carbon\Carbon::parse($user->birthday)->format('m/d/Y')}}</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="row">
                                        <label class="col-md-3 control-label" for="textinput">Home number: </label>
                                        <b class="col-md-9 completed-forms">
                                            {{$user->home_address->home_number or '-'}}
                                        </b>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="row">
                                        <label class="col-md-3 control-label" for="textinput">Mobile
                                            number: </label>
                                        <b class="col-md-9 completed-forms">
                                            {{ isset($user->home_address->mobile_number) && !empty($user->home_address->mobile_number) ? $user->home_address->mobile_number : '-' }}
                                        </b>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <hr>
                                    <div class="h3">Your home address</div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <div class="row">
                                                <div class="col-md-9 completed-forms">
                                                    {{ $user->home_address->address1 or '-' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <div class="row">
                                                <div class="col-md-9 completed-forms">
                                                    {{ $user->home_address->address2 or '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <div class="row">
                                                <div class="col-md-9 completed-forms">
                                                    {{ $user->home_address->city or '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <div class="row">
                                                <div class="col-md-9 completed-forms">
                                                    {{ $user->home_address->state or '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <div class="row">
                                                <div class="col-md-9 completed-forms">
                                                    {{ $user->home_address->zip_code or '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <div class="row">
                                                <div class="col-md-9 completed-forms">
                                                    {{ $user->home_address->country or '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3 ">
                                            <a class="btn btn-primary" href="{{ url('member/profile/edit') }}"
                                               title="Edit">Edit my details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--profile details--}}
                </div>
                {{--bill details--}}
                <div class="row form-group size50 os-regular">
                    <div class="profile-col-right pull-right profile-form-container">
                        <b><span>{!! getSettingValue('US_ADDRESS') !!}</span></b>
                        <p><span>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</span></p>
                        <p><span>{!! getSetting('US_ADDRESS') !!}</span></p>
                    </div>
                </div>
                {{--end bill details--}}
            </div>
        </div>
        {{--end main content--}}
    </div>

@endsection
{{--end section--}}
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $("input[name='avatar']").change(function () {
                this.form.submit();
            });
        });
    </script>
@endsection

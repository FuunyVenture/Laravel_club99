@extends('layouts.member.app')

@section('title', 'Edit Profile')

@section('css')

@endsection
{{--open section--}}
@section('content')
    <div class="content">
        {{--content header--}}
        <div class="row">
            <div class="col-md-12">
                <h3 class="page-head-line">Update Profile</h3>
            </div>
        </div>
        {{--end content header--}}
        {{--main content-the user can change the details from profile--}}
        <div class="row" id="profile-app">
            <div class="col-xs-12 col-centred">
                <div class="row">
                    <div class="col-md-2">
                        <form action="{{url('/member/profile/update-avatar')}}" method="POST"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                @if(isset($user) && $user->avatar !="")
                                    <div class="col-md-12">
                                        <div class="profile-image">
                                            <img src="{{ asset($user->avatar) }}" width="100%" class=""
                                                 alt="User Avatar"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-12">
                                        <div class="profile-image">
                                            <img src="{{ asset('uploads/avatars/profile.svg') }}" width="100%"
                                                 class="" alt="User Avatar"/>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12" style="margin-top: 10px;">
                                <span class="btn  btn-file  btn-primary">Change picture
                                    {!! Form::file('avatar') !!}
                                </span>
                                </div>
                            </div>
                        </form>
                    </div><!-- .col-md-2-->
                    <div class="col-md-10">
                        <form action="{{url('/member/profile/edit')}}" method="POST">
                            {{method_field("PUT")}}
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="col-md-12 profile-form-container">
                                    <div class="row">
                                        <div class="col-md-10 form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label" for="textinput">First
                                                    name: </label>
                                                <div class="col-md-9">
                                                    <input id="firstname" name="firstname" type="text"
                                                           placeholder="first name"
                                                           class="form-control input-md" value="{{$user->firstname}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-10 form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label" for="textinput">Last
                                                    name: </label>
                                                <div class="col-md-9">
                                                    <input id="lastname" name="lastname" type="text" placeholder="last name"
                                                           class="form-control input-md" value="{{$user->lastname}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10 form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label" for="email">Email
                                                    address: </label>
                                                <div class="col-md-9">
                                                    <input id="email" name="email" type="email"
                                                           placeholder="email"
                                                           class="form-control input-md" value="{{$user->email}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-10 form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label" for="textinput">Your
                                                    birthday</label>
                                                <div class="col-md-9">
                                                    <div id="birthday" value="{{$user->birthday}}"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10 form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label" for="textinput">Home
                                                    number: </label>
                                                <div class="col-md-9">
                                                    <input id="home_number" name="home_number" type="number" min="0" step="1"
                                                           placeholder="home number"
                                                           class="form-control input-md"
                                                           value="{{$user->home_address->home_number or ''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-10 form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label" for="textinput">Mobile
                                                    number: </label>
                                                <div class="col-md-9">
                                                    <input id="mobile_number" name="mobile_number" type="number" min="0" step="1"
                                                           placeholder="mobile number"
                                                           class="form-control input-md"
                                                           value="{{$user->home_address->mobile_number or ''}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h2>Your home address</h2>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <div class="row">
                                                        <label class="col-md-3 control-label"
                                                               for="textinput">Address: </label>
                                                        <div class="col-md-9">
                                                            <input id="address_line1" name="address_line1" type="text"
                                                                   placeholder="address"
                                                                   class="form-control input-md"
                                                                   v-model="addressline1"
                                                                   value="{{$user->home_address->address1 or ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <div class="row">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            <input id="address_line2" name="address_line2" type="text"
                                                                   placeholder="address"
                                                                   class="form-control input-md"
                                                                   v-model="addressline2"
                                                                   value="{{$user->home_address->address2 or ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <div class="row">
                                                        <label class="col-md-3 control-label"
                                                               for="textinput">City: </label>
                                                        <div class="col-md-9">
                                                            <input id="city" name="city" type="text" placeholder="city"
                                                                   class="form-control input-md" v-model="city"
                                                                   value="{{$user->home_address->city or ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <div class="row">
                                                        <label class="col-md-3 control-label"
                                                               for="textinput">State: </label>
                                                        <div class="col-md-9">
                                                            <select class="form-control selectpicker" id="state"
                                                                    v-model="state" name="state"
                                                                    value="{{$user->home_address->state or ''}}">
                                                                <option>State 1</option>
                                                                <option>State 2</option>
                                                                <option>State 3</option>
                                                                <option>State 4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <div class="row">
                                                        <label class="col-md-3 control-label" for="textinput">Zip
                                                            code: </label>
                                                        <div class="col-md-9">
                                                            <input id="zipcode" name="zipcode" type="text"
                                                                   placeholder="zip code"
                                                                   class="form-control input-md" v-model="zipcode"
                                                                   value="{{$user->home_address->zip_code or ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <div class="row">
                                                        <label class="col-md-3 control-label"
                                                               for="textinput">Country: </label>
                                                        <div class="col-md-9">
                                                            <select class="form-control selectpicker" id="country"
                                                                    name="country"
                                                                    v-model="country"
                                                                    value="{{$user->home_address->country or ''}}">
                                                                <option>United States</option>
                                                                <option>United Kingdom</option>
                                                                <option>Australia</option>
                                                                <option>Mexico</option>
                                                                <option>Bahamas</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 ">
                                                    <button type="submit" class="btn btn-danger">Save changes</button>
                                                </div>
                                                <div class="col-md-3 size56" style="margin-top: 12px; margin-left: 10px;">
                                                    <a href="{{url('/member/profile')}}" class="">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="form-group size44 os-regular">
                    <div class="col-md-12 profile-form-container">
                        <p><span>{{ $user->firstname or '-' }}</span> <span>{{ $user->lastname or '-' }}</span></p>
                        <p><span>{{ $user->bill_address->address1 or '-' }}</span></p>
                        <p><span>{{ $user->bill_address->address2 or '-' }}</span></p>
                        <p><span>{{ $user->bill_address->city or '-' }}</span></p>
                        <p><span>{{ $user->bill_address->state or '-' }}</span></p>
                        <p><span>{{ $user->bill_address->zip_code or '-' }}</span></p>
                    </div>
                </div>
            </div>
        </div>
        {{--end main content--}}
    </div>

@endsection
{{--end section--}}
@section('js')
    {!! Html::script('assets/dist/js/jquery-birthday-picker.js') !!}
    {!! Html::script('assets/plugins/validationengine/languages/jquery.validationEngine-en.js') !!}

    {!! Html::script('assets/plugins/validationengine/jquery.validationEngine.js') !!}
    <script type="text/javascript">
        $(document).ready(function () {
            // Validation Engine init
            var prefix = 's2id_';
            $("form[id^='validate']").validationEngine('attach',
                    {
                        promptPosition: "bottomRight", scroll: false,
                        prettySelect: true,
                        usePrefix: prefix
                    });
            $("input[name='avatar']").change(function () {
                this.form.submit();
            });
        });

        $("#birthday").birthdayPicker({
            maxAge: 100,
            minAge: 0,
            maxYear: 2016,
            "dateFormat": "middleEndian",
            "monthFormat": "number",
            "placeholder": true,
            "defaultDate": '{{\Carbon\Carbon::parse($user->birthday)->format('m-d-Y')}}',
            "sizeClass": "selectpicker"
        });

        $('form').on('submit', function() {
            $('button[type="submit"').attr('disabled', true);
        });
    </script>
@endsection

<div class="row">
    <div id="subscription-notification" class="col-xs-12">

    </div>
</div>
<div class="row" id="profile-app">
    <div class="col-xs-12 col-centred">
        <form id="create-profile-form">
            <div class="row">
                <div class=" col-xs-12 text-center">
                    <h1>Please create your profile</h1>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12 profile-form-container">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="row">
                                <label class="col-md-3 control-label label-subscription padding0" for="textinput">First
                                    name: </label>
                                <div class="col-md-9">
                                    <input id="firstname" name="firstname" type="text" placeholder="Joan"
                                           class="form-control input-md" v-model="firstname" value="{{Auth::user()->firstname}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="row">
                                <label class="col-md-3 control-label label-subscription padding0" for="textinput">Last
                                    name: </label>
                                <div class="col-md-9">
                                    <input id="lastname" name="lastname" type="text" placeholder="Jones"
                                           class="form-control input-md" v-model="lastname" value="{{Auth::user()->lastname}}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="row">
                                <label class="col-md-3 control-label label-subscription padding0" for="email">Email
                                    address: </label>
                                <div class="col-md-9">
                                    <input id="email" name="email" type="email" placeholder="Email"
                                           class="form-control input-md" value="{{Auth::user()->email}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="row">
                                <label class="col-md-3 control-label label-subscription padding0" for="textinput">Your
                                    birthday</label>
                                <div class="col-md-9">
                                    <div id="birthday"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="row">
                                <label class="col-md-3 control-label label-subscription padding0" for="textinput">Home
                                    number: </label>
                                <div class="col-md-9">
                                    <input id="home_number" name="home_number" type="number" min="0" step="1" placeholder="home number"
                                           class="form-control input-md" required pattern="[0-9]*">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="row">
                                <label class="col-md-3 control-label label-subscription padding0" for="textinput">Mobile
                                    number: </label>
                                <div class="col-md-9">
                                    <input id="mobile_number" name="mobile_number" type="number" min="0" step="1" placeholder="mobile number"
                                           class="form-control input-md" required pattern="[0-9]*">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12 profile-form-container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="row">
                                        <label class="col-md-3 control-label label-subscription padding0"
                                               for="textinput">Address: </label>
                                        <div class="col-md-9">
                                            <input id="address-line1" name="address_line1" type="text"
                                                   placeholder="Address Line 1" class="form-control input-md"
                                                   v-model="addressline1" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <input id="address-line2" name="address_line2" type="text"
                                                   placeholder="Address Line 2" class="form-control input-md"
                                                   v-model="addressline2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="row">
                                        <label class="col-md-3 control-label label-subscription padding0"
                                               for="textinput">City: </label>
                                        <div class="col-md-9">
                                            <input id="city" name="city" type="text" placeholder=""
                                                   class="form-control input-md" v-model="city" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="row">
                                        <label class="col-md-3 control-label label-subscription padding0"
                                               for="textinput">State: </label>
                                        <div class="col-md-9">
                                            <select class="form-control selectpicker" id="state" name="state" v-model="state" required>
                                                <option selected disabled>Select</option>
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
                                        <label class="col-md-3 control-label label-subscription padding0"
                                               for="textinput">Zip code: </label>
                                        <div class="col-md-9">
                                            <input id="zipcode" name="zipcode" type="text" placeholder=""
                                                   class="form-control input-md" v-model="zipcode" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="row">
                                        <label class="col-md-3 control-label label-subscription padding0"
                                               for="textinput">Country: </label>
                                        <div class="col-md-9">
                                            <select class="form-control selectpicker" id="country" name="country" v-model="country" required>
                                                <option selected disabled>Select</option>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12 profile-form-container">
                    <p><span>@{{firstname}}</span> <span>@{{ lastname }}</span></p>
                    <p><span>@{{addressline1}}</span></p>
                    <p><span>@{{addressline2}}</span></p>
                    <p><span>@{{city}}</span></p>
                    <p><span>@{{state}}</span></p>
                    <p><span>@{{zipcode}}</span></p>
                </div>
            </div>
        </form>
    </div>
    <div class="row" style="padding: 25px">
        <div class="row">
            <div class="col-md-6  col-md-offset-6 text-right size39 os-regular">
                <p>Please include all details above when placing your order with a sender</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-6 text-right">
                <a id="create-profile-btn" class="btn btn-danger">Create my profile</a>
            </div>
        </div>
    </div>
</div>

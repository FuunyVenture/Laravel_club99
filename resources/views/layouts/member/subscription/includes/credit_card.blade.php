<div class="row form-group">
    <div class="col-md-12 profile-form-container">
        <form id="credit-card-form">
            <div class="row form-group order-items-mobile">
                <div class="col-md-7" style="order: 2;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-xs-12 billing-title">Your billing address:</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="row">
                                        <label class="col-md-4 control-label label-subscription" for="address-line1">Address: </label>
                                        <div class="col-md-8">
                                            <input id="address-line1" name="address_line1" type="text"
                                                   placeholder="Address Line 1" class="form-control input-md" required
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="row">
                                        <div class="col-md-offset-4 col-md-8">
                                            <input id="address-line2" name="address_line2" type="text"
                                                   placeholder="Address Line 2" class="form-control input-md"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="row">
                                        <label class="col-md-4 control-label label-subscription"
                                               for="city">City: </label>
                                        <div class="col-md-8">
                                            <input id="city" name="city" type="text" placeholder=""
                                                   class="form-control input-md" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="row">
                                        <label class="col-md-4 control-label label-subscription"
                                               for="state">State: </label>
                                        <div class="col-md-8">
                                            <select class="form-control selectpicker" name="state" id="state" required>
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
                                        <label class="col-md-4 control-label label-subscription" for="zipcode">Zip
                                            code: </label>
                                        <div class="col-md-8">
                                            <input id="zipcode" name="zipcode" type="text" placeholder=""
                                                   class="form-control input-md" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="row">
                                        <label class="col-md-4 control-label label-subscription"
                                               for="country">Country: </label>
                                        <div class="col-md-8">
                                            <select class="form-control selectpicker" name="country" id="country"
                                                    required>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-xs-12 billing-title">Your credit card details:</div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="row">
                                        <label class="col-md-4 control-label label-subscription" for="card_name">Name on
                                            Card: </label>
                                        <div class="col-md-8">
                                            <input id="card_name" name="card_name" type="text" placeholder=""
                                                   class="form-control input-md" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="row form-group">
                                        <label class="col-md-4 control-label label-subscription" for="card_number">Credit
                                            Card
                                            Number: </label>
                                        <div class="col-md-8">
                                            <input id="card_number" name="card_number" type="text"
                                                   placeholder="0000 0000 0000 0000"
                                                   class="form-control input-md" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-offset-4 col-md-8">
                                            <ul class="list-inline card-brands">
                                                <li>
                                                    <img class="svg"
                                                         src="{{ asset('assets/dist/img/svg/amex.svg') }}"
                                                         alt=""/>
                                                </li>
                                                <li>
                                                    <img class="svg"
                                                         src="{{ asset('assets/dist/img/svg/discover.svg') }}"
                                                         alt=""/>
                                                </li>
                                                <li>
                                                    <img class="svg"
                                                         src="{{ asset('assets/dist/img/svg/mastercard.svg') }}"
                                                         alt=""/>
                                                </li>
                                                <li>
                                                    <img class="svg"
                                                         src="{{ asset('assets/dist/img/svg/visa.svg') }}"
                                                         alt=""/>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group padding0">
                                    <div class="row">
                                        <div class="col-md-6 padding-bottom">
                                            <div class="row">
                                                <label class="col-xs-6 col-md-5 col-lg-6 control-label margin-left4"
                                                       for="expire_date">Expire
                                                    date: </label>
                                                <div class="col-xs-6 col-sm-2 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-2" style="padding:0 10px 0 0;">
                                                    <input id="expire_date" name="expire_date" type="text"
                                                           placeholder=" MM / YY"
                                                           class="form-control input-md" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label class="col-xs-6 col-md-3 control-label" for="cvc">CVC: </label>
                                                <div class="col-xs-6 col-sm-2 col-md-3 col-lg-2" style="padding:0 10px 0 0;">
                                                    <input id="cvc" name="cvc" type="text" placeholder="CVC"
                                                           class="form-control input-md" required>
                                                </div>
                                                <div class="col-sm-3 col-md-5 size39 subscription-line">
                                                    The last three digits on the back of your card.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-offset-1 col-md-4 subscription-summary" style="order: 1;">
                    <div class="row">
                        <div class="col-md-12 billing-title padding0">Summary:</div>
                        <div class="col-md-12">
                            <div class="row summary-row">
                                <div class="col-xs-6 package-coupon">
                                    Package: <span style="font-weight: bold" package-name="">Lite Shopper</span>
                                </div>
                                <div class="col-xs-6 text-right package-coupon" package-price="">
                                    $200
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-right summary-total">
                            <span>Total </span><span id="price" package-price-net="">$200</span>
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <label class="col-md-6 control-label package-coupon" for="coupon_code">Apply coupon
                                    code:</label>
                                <div class="col-md-6">
                                    <input class="coupon_code form-control input-md" id="coupon_code" name="coupon_code"
                                           type="text" placeholder="" style="width:100%;">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <a id="credit-card-submit" data-form="credit-card" class="btn btn-danger pull-right payment-submit">Buy
                    subscription</a>
            </div>
        </div>
    </div>
</div>
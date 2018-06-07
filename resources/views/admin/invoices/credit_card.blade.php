<div class="col-xs-12">
    {{--open form--}}
    <form class="payment-form" action="{{url('/admin/invoices/pay/')}}" method="POST">
        {{method_field("POST")}}
        {{csrf_field()}}
        <input class="invoice_id" type="hidden" name="invoice_id" value="{{$invoice->id}}">
        <input class="coupon_" type="hidden" name="coupon_code" value="">
        <input type="hidden" name="payment_method" value="credit_card">
        <div class="row">
            <div class="col-xs-12 billing-title">Your credit card details:</div>
        </div>
        {{--main content--}}
        <div class="row invoice-address">
            <div class="col-xs-6 col-md-2 padding-tb5">Name on Card:</div>
            <div class="col-xs-6 col-md-4 padding-tb5">
                <input id="card_name" type="text" name="card_name" style="width:100%" value="{{old('card_name')}}">
            </div>
            <div class="col-xs-6 col-md-2 padding-tb5">Credit Card number:</div>
            <div class="col-xs-6 col-md-4 padding-tb5">
                <input id="card_number" type="text" name="card_number" style="width:100%" value="{{old('card_number')}}">
                <div class="row" style="padding-top:10px;padding-left:16px;">
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
        <div class="row">
            <div class="col-xs-12 col-lg-8 form-group">
                <div class="col-md-5 padding-bottom">
                    <div class="row">
                        <label class="col-xs-6 col-md-5 col-md-offset-1 control-label padding0" for="expire_date">Expire
                            date: </label>
                        <div class="col-xs-6 col-md-5">
                            <input id="expire_date" name="expire_date" type="text"
                                   placeholder="MM / YY"
                                   value="{{old('expire_date')}}"
                                   class="form-control input-md text-center">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="row">
                        <label class="col-xs-6 control-label padding0" for="cvc">Security code:</label>
                        <div class="col-xs-6">
                            <input id="cvc" name="cvc" type="text" placeholder="CVC" value="{{old('cvc')}}"
                                   class="form-control input-md text-center">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 padding0" style="line-height: 17px; font-size:11px;">The last three digits on the
                    back of your card.
                </div>
            </div>
        </div>
        {{--end main content--}}
        {{--content footer--}}
        <div class="row text-right">
            <div class="col-md-12">
                <button type="submit" class="btn btn-danger btn-invoices">Pay invoice</button>
            </div>
        </div>
        {{--end content footer--}}
    </form>
    {{--end form--}}
</div>
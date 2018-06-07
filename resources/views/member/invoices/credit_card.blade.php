<div class="col-xs-12">
    {{--open form--}}
    <form class="payment-form" action="{{url('/member/invoices/pay/')}}" method="POST">
        {{method_field("POST")}}
        {{csrf_field()}}
        <input class="invoice_id" type="hidden" name="invoice_id" value="{{$invoice->id}}">
        <input class="coupon_" type="hidden" name="coupon_code" value="">
        <input type="hidden" name="payment_method" value="credit_card">
        <div class="row">
            <div class="col-xs-12 billing-title">Your credit card details:</div>
        </div>
        {{--main content--}}
        <div class="row flex end">
            <div class="col-xs-12 col-lg-4">
                <label class="control-label">Name on Card:</label>
                <div class="completed-invoice">
                    <input id="card_name" class="input100" type="text" name="card_name" placeholder="">
                </div>
            </div>
            <div class="col-xs-12 col-lg-8">
                <div>
                    <span class="control-label">Credit Card number:</span>
                    <span class="card-brands">    
                        <img class="svg"
                             src="{{ asset('assets/dist/img/svg/amex.svg') }}"
                             alt=""/>
                        <img class="svg"
                             src="{{ asset('assets/dist/img/svg/discover.svg') }}"
                             alt=""/>    
                        <img class="svg"
                             src="{{ asset('assets/dist/img/svg/mastercard.svg') }}"
                             alt=""/>    
                        <img class="svg"
                             src="{{ asset('assets/dist/img/svg/visa.svg') }}"
                             alt=""/>
                    </span>
                </div>
                <div class="completed-invoice">
                    <input id="card_number" class="input100" type="text" name="card_number">
                </div>
            </div>
        </div>
        {{--end main content--}}
        {{--content footer--}}
        <div class="row flex padding-bottom">
            <div class="col-xs-12 col-md-5 form-group">
                <div class="row col-md-6 padding-bottom">
                    <label class="control-label" for="expire_date">Expire date:</label>
                    <div>
                        <input id="expire_date" name="expire_date" type="text"
                               placeholder=" MM / YY"
                               class="form-control input-md input100">
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label class="control-label" for="cvc">Security code:</label>
                        <div>
                            <input id="cvc" name="cvc" type="text" placeholder="CVC"
                                   class="form-control input-md input100">
                        </div>
                    </div>
                    <div class="control-label note margin-tb">The last three digits on the back of your card.</div>
                </div>
            </div>
            
            <div class="col-xs-12 col-md-7 text-right">
                <button type="submit" class="btn btn-primary btn-invoices">Pay invoice</button>
            </div>
        </div>
        {{--end content footer--}}
    </form>
    {{--end form--}}
</div>
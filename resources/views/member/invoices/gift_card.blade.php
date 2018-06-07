<div class="row-fluid form-group">
    <div class="col-xs-12">
        {{--open form--}}
        <form class="payment-form" action="{{url('/member/invoices/pay/')}}" method="POST">
            {{method_field("POST")}}
            {{csrf_field()}}
            <input class="invoice_id" type="hidden" name="invoice_id" value="{{$invoice->id}}">
            <input class="coupon_" type="hidden" name="coupon_code" value="">
            <input type="hidden" name="payment_method" value="gift_card">
            {{--main content--}}
            <div class="form-group">

                <div class="billing-title">Use your gift card:</div>

                <div class="row flex">
                    <div class="col-xs-12 col-md-5 form-group">
                        <label class="control-label label-subscription"
                               for="textinput">Code: </label>
                        <input id="coupon_number" name="coupon_number" type="text" placeholder=""
                               class="form-control input-md input100" required>
                    </div>
                    <div class="col-xs-12 col-md-7 text-right">
                        <button type="submit" class="btn btn-primary btn-invoices">Pay invoice</button>
                    </div>
                </div>
            </div>
            {{--end main content--}}
            {{--content footer--}}

            {{--end content footer--}}
        </form>
        {{--end form--}}
    </div>
</div>

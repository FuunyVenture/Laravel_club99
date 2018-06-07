<div class="row-fluid form-group">
    <div class="col-md-12">
        {{--open form--}}
        <form class="payment-form" action="{{url('/admin/invoices/pay/')}}" method="POST">
            {{method_field("POST")}}
            {{csrf_field()}}
            <input class="invoice_id" type="hidden" name="invoice_id" value="{{$invoice->id}}">
            <input class="coupon_" type="hidden" name="coupon_code" value="">
            <input type="hidden" name="payment_method" value="gift_card">
            {{--main content--}}
            <div class="row form-group">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-xs-12 billing-title">Use your gift card:</div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="row">
                                        <label class="col-xs-3 control-label label-subscription"
                                               for="textinput">Code: </label>
                                        <div class="col-xs-9">
                                            <input id="coupon_number" name="coupon_number" type="text" placeholder=""
                                                   class="form-control input-md" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
</div>

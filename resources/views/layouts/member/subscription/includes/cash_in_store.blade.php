<div class="row form-group">
    <div class="col-md-12 profile-form-container">
        <form id="cash-in-store-form">
            <div class="row form-group">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-xs-12 billing-title">Apply your store receipt</div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="row">
                                        <label class="col-xs-4 control-label label-subscription"
                                               for="textinput">Code: </label>
                                        <div class="col-xs-8">
                                            <input id="receipt_code" name="receipt_code" type="text" placeholder=""
                                                   class="form-control input-md" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-offset-1 col-md-4 subscription-summary">
                    <div class="row">
                        <div class="col-md-12 billing-title padding0">Summary:</div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-xs-6 package-coupon">
                                    Package: <span style="font-weight: bold" package-name="">Lite Shopper</span>
                                </div>
                                <div class="col-xs-6 text-right package-coupon" package-price="">
                                    $200
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-right summary-total">
                            <span>Total </span><span id="price" package-price="">$200</span>
                        </div>

                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <a id="cash-in-store-submit" data-form="cash-in-store" class="btn btn-danger pull-right payment-submit">
                    Buy subscription
                </a>
            </div>
        </div>
    </div>
</div>

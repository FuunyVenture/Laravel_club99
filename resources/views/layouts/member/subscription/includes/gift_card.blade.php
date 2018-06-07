<div class="row form-group">
    <div class="col-md-12 profile-form-container">
        <form id="gift-card-coupon-form">
        <div class="row form-group">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-xs-12 billing-title">Use your gift card: </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <div class="row">
                                    <label class="col-xs-4 control-label label-subscription" for="textinput">Code: </label>
                                    <div class="col-xs-8">
                                        <input id="coup_number" name="gift_card_number" type="text" placeholder=""
                                               class="form-control input-md" required style="width:100%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-offset-1 col-md-4 subscription-summary">
                <div class="row">
                    <div class="col-md-12 billing-title padding0">Summary: </div>
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
                            <label class="col-xs-6 control-label package-coupon" for="coupon_code_gc">Apply coupon code:</label>
                            <div class="col-xs-6">
                                <input class="coupon_code form-control input-md" id="coupon_code_gc" name="coupon_code" type="text" placeholder=""
                                       style="width:100%;">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a data-form="gift-card-coupon" class="btn btn-danger pull-right payment-submit">Buy subscription</a>
            </div>
        </div>
    </div>
</div>

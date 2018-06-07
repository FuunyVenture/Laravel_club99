{{--This is the last step of the shipment. The member need to confirm the details--}}
<div class="row confirmation">
    <div class="col-md-12">
        <div class="row">
            <h2>Please confirm these details are correct</h2>
        </div>
        <div class="row os-regular size50">
            <div class="col-xs-6 col-md-4 padding-tb5" id="confirmation-sender">
                <span>Sender: </span>
                <span></span>
            </div>
            <div class="col-xs-6 col-md-4 padding-tb5" id="confirmation-tracking-number">
                <span>Tracking number: </span>
                <span></span>
            </div>
            <div class="col-xs-6 col-md-4 padding-tb5" id="confirmation-order-number">
                <span>Order number: </span>
                <span></span>
            </div>
            <div class="col-xs-6 col-md-4 padding-tb5" id="confirmtion-weight">
                <span>Weight: </span>
                <span></span>
            </div>
            <div class="col-xs-6 col-md-4 padding-tb5" id="confirmation-dimensions">
                <span>Dimensions: </span>
                <span></span>
            </div>
            <div class="col-xs-6 col-md-4 padding-tb5" id="confirmation-invoice">
                <a href="" download="">View invoice</a>
            </div>
        </div>
        <div class="border-bottom-grey"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row" style="margin-left: 0px;"><h4>Member details</h4></div>
            </div>
            <div class="col-xs-12 col-sm-6 size44 os-regular">
                <div class="row">
                    <div class="col-xs-12 padding-tb5" id="confirmation-member-details"></div>
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-5">Address:</div>
                            <div class="col-xs-7 padding-tb5" id="confirmation-address"></div>
                            <div class="col-xs-7 col-xs-offset-5 padding-tb5" id="confirmation-city"></div>
                            <div class="col-xs-7 col-xs-offset-5 padding-tb5" id="confirmation-state"></div>
                            <div class="col-xs-7 col-xs-offset-5 padding-tb5" id="confirmation-zip-code"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 size44 os-regular">
                <div class="row">
                    <div class="col-xs-12 padding-tb5">
                        <div class="row">
                            <div class="col-xs-5">First name:</div>
                            <div class="col-xs-7" id="confirmation-firstname"></div>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-5">Last name:</div>
                            <div class="col-xs-7" id="confirmation-lastname"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-bottom-grey"></div>
        <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-7 purchase-details">
                <div class="row"><h4>Purchase details</h4></div>
                <table id="data_table" class="table datatable dt-responsive"
                       style="width:100%; border-bottom:1px solid grey;">
                    <thead>
                    <tr>
                        <th>Qty</th>
                        <th>Description</th>
                        <th>Item value</th>
                    </tr>
                    </thead>
                    <tbody id="confirmation-items">
                    </tbody>
                </table>
                {{--<div class="border-bottom-grey"></div>--}}
                <div class="row os-regular size44">
                    <div class="col-xs-8 text-right">Subtotal:</div>
                    <div class="col-xs-4" id="confirmation-subtotal"></div>
                </div>
                <div class="row os-regular size44">
                    <div class="col-xs-8 text-right">Shipping cost:</div>
                    <div class="col-xs-4" id="retailer-shipping-cost"></div>
                </div>
                <div class="row os-regular size44">
                    <div class="col-xs-8 text-right">Tax:</div>
                    <div class="col-xs-4" id="retailer-tax"></div>
                </div>
                <div class="row os-regular size44">
                    <div class="col-xs-8 text-right">Total shipment value:</div>
                    <div class="col-xs-4" style="color:#7da3f4; font-size: 20px;" id="confirmation-total"></div>
                </div>
            </div>
            <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-2 col-md-5 col-lg-4 costs-box os-semibold size44">
                <h4>Shipment costs</h4>
                <div class="row">
                    <div class="col-xs-8 text-right">Total duty:</div>
                    <div class="col-xs-4 text-left" id="confirmation-duty"></div>
                </div>
                <div class="row">
                    <div class="col-xs-8 text-right">
                        Total VAT{{ '@' . getSetting('VAT_TAX') }}%:
                    </div>
                    <div class="col-xs-4 text-left" id="confirmation-vat"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row msg" style="display: none;">
    <div class="col-xs-12 notification size50 os-regular"></div>
    <div class="col-xs-12 instructions size50 os-regular">
        Our team will review your order, when it has been approved an invoice will be emailed to you.
    </div>
    <div class="margin2030">
        <div class="col-xs-12 msg-on-success bottom-border">
        </div>
        <div class="col-xs-12 msg-on-success padding0">
            <a class="btn btn-create" id="reset-wizard">Create another shipment</a>
            <a class="btn btn-danger close-wizard " style="float:right">Done</a>
        </div>
    </div>
    <div class="col-xs-12 msg-on-error">
        <a class="btn btn-danger close-wizard">Close</a>
    </div>
</div>
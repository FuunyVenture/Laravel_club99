{{--This is the third step of the shipment. In this step, member can add details of his purchase--}}
<div class="row purchase-details">
    <div class="col-md-10 col-md-offset-2">
        <form id="purchase-details-form" role="form">
            <div class="row">
                <h3>Please add the details of your purchase</h3>
            </div>
            <div class="row">
                <h4>Did you pay any shipment costs?</h4>
                <div class="col-md-6">
                    <div class="radio">
                        <label>
                            <input type="radio" name="shipping_view" value="no" checked>
                            No, shipment was free
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="shipping_view" value="yes">
                                    Yes, I paid some shipping cost
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12" id="shipping-amount-view">
                            <div class="">
                                <label class="col-sm-6 col-md-6">Amount paid on shipping:</label>
                                <div class="col-sm-6 col-md-6">
                                    <div class="input-group flex">
                                        <div class="col-md-1"><span>$</span></div>
                                        <div clas="col-md-11">
                                            <input type="text" class="form-control" name="shipping_amount"
                                                   placeholder="0.00" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h4>Did you pay any tax on your purchase?</h4>
                <div class="col-md-6">
                    <div class="radio">
                        <label>
                            <input type="radio" name="tax_view" value="no" checked>
                            No, tax was not included
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="tax_view" value="yes">
                                    Yes, i paid tax
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12" id="tax-amount-view">
                            <div class="">
                                <label class="col-sm-6 col-md-6">Total amount paid on tax:</label>
                                <div class="col-sm-6 col-md-6">
                                    <div class="input-group flex">
                                        <div class="col-md-1"><span>$</span></div>
                                        <div clas="col-md-11">
                                            <input type="text" class="form-control" name="tax_amount" placeholder="0.00"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    /* Handle shipping cost and tax fields visibility based on radio button inputs. */
    $(document).ready(function () {
        $('#shipping-amount-view').hide();
        $('#tax-amount-view').hide();

        $('input[name="shipping_view"]').on('change', function () {
            if ($(this).val() == 'yes')
                $('#shipping-amount-view').show();
            else
                $('#shipping-amount-view').hide();
        });

        $('input[name="tax_view"]').on('change', function () {
            if ($(this).val() == 'yes')
                $('#tax-amount-view').show();
            else
                $('#tax-amount-view').hide();
        });
    })
</script>
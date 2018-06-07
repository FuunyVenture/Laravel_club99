{{--This view generate a GUI that allows the member to pay their invoice--}}
@extends('layouts.admin.app')

@section('title', 'Pay invoice')

@section('css')

@endsection
{{--open section--}}
@section('content')
    <div class="content">
        {{--content header--}}
        <div class="row">
            <div class="col-xs-12 back"><a href="{{ url('admin/invoices') }}">
                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a></div>
            <div class="col-xs-12"><h3>Pay invoice</h3></div>
        </div>
        {{--end content header--}}
        {{--main content--}}
        <div class="row">
            <div class="col-xs-12">
                <div class="new-box">
                    <div class="row">
                        <div class="col-xs-12 col-md-4 col-lg-3 padding-tb">
                            <div class="row"><h4>Your billing address:</h4></div>
                        <!-- <div class="row"><strong>{{ $user->firstname . ' ' . $user->lastname }}</strong></div> -->
                            <div class="row padding-tb">
                                <div class="col-xs-3 invoice-address">Address:</div>
                                <div class="col-xs-9 completed-invoice">
                                    <input class="input100" type="text" name="address1"
                                           value="{{$user->bill_address->address1 or ''}}" required>
                                </div>
                            </div>
                            <div class="row padding-tb">
                                <div class="col-xs-9 col-xs-offset-3 completed-invoice">
                                    <input class="input100" type="text" name="address2"
                                           value="{{$user->bill_address->address2 or ''}}" >
                                </div>
                            </div>
                            <div class="row padding-tb">
                                <div class="col-xs-3 invoice-address">City:</div>
                                <div class="col-xs-9 completed-invoice">
                                    <input class="input100" type="text" name="city"
                                           value="{{$user->bill_address->city or ''}}" required>
                                </div>
                            </div>
                            <div class="row padding-tb">
                                <div class="col-xs-3 invoice-address">Country:</div>
                                <div class="col-xs-9 completed-invoice">
                                    <input class="input100" type="text" name="state"
                                           value="{{$user->bill_address->state or ''}}" required>

                                </div>
                            </div>
                            <div class="row padding-tb">
                                <div class="col-xs-3 invoice-address">Postal Code:</div>
                                <div class="col-xs-9 completed-invoice">
                                    <input class="input100" type="text" name="zipcode"
                                           value="{{$user->bill_address->zip_code or ''}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-7 col-lg-8 invoice-table">
                            <div class="row" style="margin: 5px;"><h4>Summary:</h4></div>
                            <table id="data_table" class="table datatable dt-responsive"
                                   style="width:100%;border-bottom: 1px solid #f4f4f4;">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Duty cost</th>
                                    <th>Tax</th>
                                    <th>Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $subTotal = 0; $totalVat = 0; ?>
                                @foreach($invoice->products as $product)
                                    <tr>
                                        <td>
                                            @if($product->type == 'shipment')
                                                <a href="{{url('admin/shipments/' . $product->shipment->id)}}">
                                                    {{$product->shipment->name}}
                                                </a>
                                            @elseif($product->type == 'fee')
                                                <a href="{{url('admin/products/' . $product->fee->id)}}">
                                                    {{$product->fee->name}}
                                                </a>
                                            @elseif($product->type == 'package')
                                                <a href="{{url('admin/packages/' . $product->package->id)}}">
                                                    {{$product->package->name}}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->type == 'shipment')
                                                ${{number_format($product->shipment->duty_cost, 2, '.', ',')}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->type == 'shipment')
                                                ${{number_format($product->shipment->duty_tax, 2, '.', ',')}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->type == 'shipment')
                                                ${{number_format(($product->shipment->duty_cost + $product->shipment->duty_tax), 2, '.', ',')}}
                                            @elseif($product->type == 'fee')
                                                ${{$product->fee->cost}}
                                            @elseif($product->type == 'package')
                                                ${{$product->package->cost}}
                                            @endif
                                        </td>
                                    </tr>
                                    <?php
                                    if ($product->type == 'shipment') {
                                        $subTotal += $product->shipment->duty_cost + $product->shipment->duty_tax;
                                    } else if ($product->type == 'fee') {
                                        $subTotal += $product->fee->cost;

                                        if ($product->fee->taxable == 'taxable') {
                                            $totalVat += getSetting('VAT_TAX') / 100 * $product->fee->cost;
                                        }
                                    } else if ($product->type == 'package') {
                                        $subTotal += $product->package->cost;
                                    }
                                    ?>
                                @endforeach
                                </tbody>
                            </table>
                            <div id="subtotal-row" class="row completed-invoice">
                                <div class="col-xs-9 text-right ">Sub total:</div>
                                <div class="col-xs-3"> ${{number_format($subTotal, 2, '.', ',')}}</div>
                            </div>
                            <div id="vat-row" class="row completed-invoice">
                                <div class="col-xs-9 text-right">Total VAT{{ '@' . getSetting('VAT_TAX') }}%:</div>
                                <div class="col-xs-3"> ${{number_format($totalVat, 2, '.', ',')}}</div>
                            </div>
                            <div id="total-row" class="row">
                                <div class="col-xs-9 text-right completed-invoice">Total due:</div>
                                <div class="col-xs-3 total-price-invoice"
                                     invoice-total="{{number_format($subTotal + $totalVat, 2, '.', ',')}}">
                                    <strong> ${{number_format($subTotal + $totalVat, 2, '.', ',')}}</strong></div>

                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-10 col-sm-offset-1 text-right"
                                     style="padding-bottom: 10px;">
                                    <div class="row">
                                        <div class="col-xs-5 col-sm-6 col-md-5 col-lg-8 completed-invoice"
                                             style="margin-top: 7px;">
                                            <span>Apply coupon code:</span>
                                        </div>
                                        <div class="col-xs-7 col-sm-6 col-md-7 col-lg-3">
                                            <input id="coupon_code" class="size44 coupon_code" type="text"
                                                   name="cupon_code">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 ">
                                <div class="row">
                                    <div class=" col-xs-12 text-center title-subscription">
                                        What payment option do you like to use?
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-11 col-md-9 col-centred">
                                        <ul class="nav nav-pills">
                                            <li role="presentation">
                                                <a id="credit_card" class="btn btn-default btn-lg" href="#credit-card"
                                                   aria-controls="credit-card" role="tab"
                                                   data-toggle="tab">
                                                    <div>
                                                        <img class="svg"
                                                             src="{{ asset('assets/dist/img/svg/cards.svg') }}"
                                                             alt=""/>
                                                    </div>
                                                    <div class="payment-options">Credit card</div>
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a id="cash_in_store" class="btn btn-default btn-lg" href="#cash-in-store"
                                                   aria-controls="credit-card" role="tab"
                                                   data-toggle="tab">
                                                    <div>
                                                        <img class="svg"
                                                             src="{{ asset('assets/dist/img/svg/truck.svg') }}"
                                                             alt=""/>
                                                    </div>
                                                    <div class="payment-options mobile-options">Cash in store</div>
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a id="gift_card" class="btn btn-default btn-lg" href="#gift-card-coupon"
                                                   aria-controls="credit-card"
                                                   role="tab" data-toggle="tab">
                                                    <div>
                                                        <img class="svg"
                                                             src="{{ asset('assets/dist/img/svg/coupon.svg') }}"
                                                             alt=""/>
                                                    </div>
                                                    <div class="payment-options">Gift card</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade" id="credit-card">
                                @include('admin.invoices.credit_card')
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="cash-in-store">
                                @include('admin.invoices.cash_in_store')
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="gift-card-coupon">
                                @include('admin.invoices.gift_card')
                            </div>
                        </div>
                        {{--Gift cards will become active in the future; the following code is needed for gift cards--}}
                        {{--                    <div class="col-xs-12">
                                                <div class="row"><h3>Your credit card details:</h3></div>
                                                <div class="row">
                                                    <div class="col-xs-6 col-md-2 padding-tb5">Name on Card:</div>
                                                    <div class="col-xs-6 col-md-4 padding-tb5"><input type="" name="" style="width:100%" placeholder="0000 0000 0000 0000"></div>
                                                    <div class="col-xs-6 col-md-2 padding-tb5">Credit Card number:</div>
                                                    <div class="col-xs-6 col-md-4 padding-tb5">
                                                        <input type="" name="" style="width:100%">
                                                        <div class="row" style="padding-top:10px;padding-left:16px;">
                                                            <img src="ceva.jpg">
                                                            <img src="ceva.jpg">
                                                            <img src="ceva.jpg">
                                                            <img src="ceva.jpg">
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
                                                                                           placeholder=" MM / YY"
                                                                                           class="form-control input-md text-center" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-4">
                                                            <div class="row">
                                                                <label class="col-xs-6 control-label padding0" for="cvc">Security code:</label>
                                                                <div class="col-xs-6">
                                                                    <input id="cvc" name="cvc" type="text" placeholder="CVC"
                                                                           class="form-control input-md text-center" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 padding0" style="line-height: 17px; font-size:11px;">The last three digits on the back of your card.</div>
                                                    </div>
                                                </div>
                                                <div class="row text-right">
                                                    <a class="btn btn-danger btn-invoices">Pay invoice</a>
                                                </div>
                                            </div>--}}
                    </div>
                </div>
            </div>
        </div>
        {{--end main content--}}
    </div>
@endsection
{{--end section--}}

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            var delayTimer;

            var session_payment_method = '{{Session::get('payment_method')}}';
            if(session_payment_method && session_payment_method.trim() != '')
                $('#' + session_payment_method).click();

            function doSearch(text) {
                clearTimeout(delayTimer);
                delayTimer = setTimeout(function () {
                    var url = '{{url('/admin/subscription/verify-coupon')}}';
                    var data = {};
                    data.coupon_code = text;
                    data._token = '{{ csrf_token() }}';
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: data,
                        success: function (data, status, headers) {
                            var invoiceTotal = parseFloat($('*[invoice-total]').attr('invoice-total').replace(',', ''));
                            if (data.error) {
                                $('.total-price-invoice').html('<strong>$ ' + invoiceTotal.toFixed(2) + '</strong>');
                                $('.summary-coupon-row').remove();
                                $('.coupon-error').remove();
                                $('.coupon_code').after($('<span class="coupon-error">' + data.error.message + '</span>'));
                                $('.coupon_').remove();

                            } else {
                                var price = invoiceTotal - (data.coupon.type == 'percentage' ? ((data.coupon.value / 100) * invoiceTotal) : data.coupon.value);
                                $('.summary-coupon-row').remove();
                                $('.coupon-error').remove();
                                $('#vat-row').after($('<div class="row summary-coupon-row size44"><div class="col-xs-9 text-right"><strong>Coupon Discount:</strong> </div>' +
                                        '<div class="col-xs-2">-' +
                                        '$' + (data.coupon.type == 'percentage' ? ((data.coupon.value / 100) * invoiceTotal) : data.coupon.value).toFixed(2) + ' </div></div>'
                                ));
                                $('.total-price-invoice').html('<strong>$ ' + price.toFixed(2) + '</strong>');

                            }

                        },
                        error: function (data, status, headers) {

                        }
                    });
                }, 1000);
            }

            $('.coupon_code').on('input', function () {
                if ($(this).val()) {
                    $('.coupon_').val($(this).val());
                    $('.coupon_code').val($(this).val());
                    doSearch($(this).val());
                } else {
                    $('.coupon-error').remove();
                    $('.coupon_').remove();
                }
            });

            $('.payment-form').submit(function () {
                $(this).find('button[type="submit"]').attr('disabled', true);
                var span = $('<span></span>');
                span.hide();
                span.append($('[name="address1"]'));
                span.append($('[name="address2"]'));
                span.append($('[name="city"]'));
                span.append($('[name="zipcode"]'));
                span.append($('[name="state"]'));
                $(this).append(span);
            });
        });
    </script>
@endsection
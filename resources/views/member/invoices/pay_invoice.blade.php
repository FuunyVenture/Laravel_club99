{{--This view generate a GUI that allows the member to pay their invoice--}}
@extends('layouts.member.app')

@section('title', 'Pay invoice')

@section('css')

@endsection
{{--open section--}}
@section('content')
    <div class="content">
        {{--content header--}}
        <div class="row">
            <div class="col-xs-12 back"><a href="{{ url('member/invoices') }}">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>Back</a></div>
            <div class="col-xs-12 page-head-line">Pay invoice</div>
        </div>
        {{--end content header--}}
        {{--main content--}}
        <div class="row">
            <div class="col-xs-12">
                <div class="well-box pay">
                    <div class="row">
                        <div class="col-md-12 col-lg-4 breakpoint">
                            <div class="invoice-address pay-address">Your billing address:</div>
                            <!-- <div class="row"><strong>{{ $user->firstname . ' ' . $user->lastname }}</strong></div> -->
                            <div class="row padding-tb5">
                                <span class="col-xs-12 col-sm-3 invoice-address v-center">Address:</span>
                                <span class="col-xs-12 col-sm-9 completed-invoice">
                                    <input class="input100" type="text" name="address1"
                                           value="{{$user->bill_address->address1 or ''}}">
                                </span>
                            </div>
                            <div class="row padding-tb5">
                                <div class="col-xs-12 col-sm-9 col-sm-offset-3 completed-invoice">
                                    <input class="input100" type="text" name="address2"
                                           value="{{$user->bill_address->address2 or ''}}">
                                </div>
                            </div>
                            <div class="row padding-tb">
                                <div class="col-xs-12 col-sm-3 invoice-address v-center">City:</div>
                                <div class="col-xs-12 col-sm-9 completed-invoice">
                                    <input class="input100" type="text" name="city"
                                           value="{{$user->bill_address->city or ''}}">
                                </div>
                            </div>
                            <div class="row padding-tb">
                                <div class="col-xs-12 col-sm-3 invoice-address v-center">Country:</div>
                                <div class="col-xs-12 col-sm-9 completed-invoice">
                                    <input class="input100" type="text" name="state"
                                           value="{{$user->bill_address->state or ''}}">

                                </div>
                            </div>
                            <div class="row padding-tb">
                                <div class="col-xs-12 col-sm-3 invoice-address v-center">Postal Code:</div>
                                <div class="col-xs-12 col-sm-9 completed-invoice">
                                    <input class="input100" type="text" name="zipcode"
                                           value="{{$user->bill_address->zip_code or ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-8 breakpoint col-space-table">
                            <div class="detail-head-line">Summary:</div>
                            <div class="panel panel-default detail">
                                <table id="data_table" class="table datatable dt-responsive detail">
                                    <thead>
                                    <tr class="os-bold">
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
                                            <td class="os-semibold">
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
                                        } else {
                                            $subTotal += $product->fee->cost;
                                
                                            if ($product->fee->taxable == 'taxable') {
                                                $totalVat += getSetting('VAT_TAX') / 100 * $product->fee->cost;
                                            }
                                        }
                                        ?>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>  

                            <div class="row cupon_small margin-t">
                                <div class="col-sm-12 col-md-7 v-center">
                                    <div class="completed-invoice cupon_code">
                                        <span class="detail-head-line coupon_code">Apply coupon code:</span>
                                        <input id="coupon_code" type="text"
                                               name="cupon_code" placeholder="your code here">
                                    </div>
                                </div>
                                
                                <div class="col-sm-12 col-md-5 text-right">
                                    <div id="subtotal-row" class="os-regular size39">
                                            Subtotal:
                                            <strong>${{number_format($subTotal, 2, '.', ',')}}</strong>
                                        </div>
                                    <div id="vat-row" class="os-regular size39">
                                        Total VAT{{ '@' . getSetting('VAT_TAX') }}%:
                                        ${{number_format($totalVat, 2, '.', ',')}}
                                    </div>
                                    <div id="total-row" class="os-regular size39 margin-tb">
                                        Total due:
                                        <span class="completed-invoice total" invoice-total="{{number_format($subTotal + $totalVat, 2, '.', ',')}}">
                                            ${{number_format($subTotal + $totalVat, 2, '.', ',')}}
                                        </span>
                                    </div>    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="text-center title-subscription-pay">
                                    What payment option do you like to use?
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                                        <ul class="nav nav-pills">
                                            <li role="presentation">
                                                <a class="btn" href="#credit-card"
                                                   aria-controls="credit-card" role="tab"
                                                   data-toggle="tab">
                                                    <img class="svg"
                                                         src="{{ asset('assets/dist/img/svg/cards.svg') }}"
                                                         alt=""/>
                                                    <span class="payment-options">Credit card</span>
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a class="btn" href="#cash-in-store"
                                                   aria-controls="credit-card" role="tab"
                                                   data-toggle="tab">
                                                    <img class="svg"
                                                         src="{{ asset('assets/dist/img/svg/truck.svg') }}"
                                                         alt=""/>
                                                    <span class="payment-options mobile-options">Cash in store</span>
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a class="btn" href="#gift-card-coupon"
                                                   aria-controls="credit-card"
                                                   role="tab" data-toggle="tab">
                                                    <img class="svg"
                                                         src="{{ asset('assets/dist/img/svg/coupon.svg') }}"
                                                         alt=""/>
                                                    <span class="payment-options">Gift card</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="tab-content">
                            <div role="tabpanel" class="row tab-pane fade" id="credit-card">
                                <div class="col-xs-12 col-md-8 col-md-offset-2">@include('member.invoices.credit_card')</div>
                            </div>
                            <div role="tabpanel" class="row tab-pane fade" id="cash-in-store">
                                <div class="col-xs-12 col-md-8 col-md-offset-2">@include('member.invoices.cash_in_store')</div>
                            </div>
                            <div role="tabpanel" class="row tab-pane fade" id="gift-card-coupon">
                                <div class="col-xs-12 col-md-8 col-md-offset-2">@include('member.invoices.gift_card')</div>
                            </div>
                        </div>                        

                        {{--Gift cards will become active in the future; the following code is needed for gift cards--}}
                        {{--    <div class="col-xs-12">
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

            function doSearch(text) {
                clearTimeout(delayTimer);
                delayTimer = setTimeout(function () {
                    var url = '{{url('/member/subscription/verify-coupon')}}';
                    var data = {};
                    data.coupon_code = text;
                    data._token = '{{ csrf_token() }}';
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: data,
                        success: function (data, status, headers) {
                            var invoiceTotal = parseFloat($('*[invoice-total]').attr('invoice-total'));
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
                $('button[type="submit"]').attr('disabled', true);

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
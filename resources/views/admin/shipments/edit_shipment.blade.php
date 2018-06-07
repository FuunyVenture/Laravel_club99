@extends('layouts.admin.app')

@section('title', 'Edit Shipment')

@section('css')
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }

        input[type=number]:after {
            position: absolute;
            top: 0;
            content: "$";
            right: 5px;
        }
    </style>
@endsection

@section('content')
    {{--open form--}}
    <form action="{{url('admin/shipments/' . $shipment->id)}}" method="POST" novalidate>
        {{method_field('PUT')}}
        {{csrf_field()}}
        <div class="content">
            <div class="row">
                {{--content header--}}
                <div class="col-xs-12 back">
                    <a href="{{ url('admin/shipments') }}">
                        <i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a>
                </div>
                <div class="col-xs-12"><h3>Edit shipment </h3></div>
                {{--end content header--}}
                {{--main content-the admin can edit shipments--}}
                <div class="col-xs-12">
                    <div class="new-box">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-xs-5 col-md-4 col-lg-1 invoice-address" style="margin-left: 15px;">
                                        ShipmentID:
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-1 completed-invoice">
                                        <strong>{{$shipment->id}}</strong>
                                    </div>
                                    <div class="col-xs-12 col-md-4 col-lg-1 padding-tb5 completed-invoice">
                                        <label for="status">Status</label>
                                        <select name="status" id="status">
                                            @foreach($shipmentStatusMap as $key => $value)
                                                <option value="{{$key}}" {{$shipment->status == $key ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-xs-12 col-lg-4 padding-tb5">
                                        <div class="col-xs-4 col-lg-3 invoice-address">Sender:</div>
                                        <div class="col-xs-8 completed-invoice">
                                            <select class="small-select" name="retailer" required>
                                                @foreach($retailers as $retailer)
                                                    <option value="{{$retailer->id}}"
                                                            @if($shipment->retailer->id == $retailer->id) selected @endif>
                                                        {{$retailer->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-lg-8 padding-tb5">
                                        <div class="col-xs-4 invoice-address">Tracking number:</div>
                                        <div class="col-xs-8 completed-invoice">
                                            <input value="{{$shipment->tracking_number}}" type="text"
                                                   name="tracking_number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-4 padding-tb5">
                                        <div class="col-xs-4 col-md-3 invoice-address">Weight:</div>
                                        <div class="col-xs-4 col-md-4 col-lg-2 completed-invoice">
                                            <input class="text-center" value="{{$shipment->weight}}" type="text"
                                                   style="width:100%;" name="weight">
                                        </div>
                                        <div class="col-xs-2 completed-invoice">lbs</div>
                                    </div>
                                    <div class="col-xs-12 col-md-8 padding-tb5">
                                        <div class="col-xs-12 col-md-4 invoice-address">Dimensions:</div>
                                        <div class="col-xs-12 col-md-8 col-lg-6 completed-invoice">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <div class="row">
                                                        <div class="col-xs-8 col-sm-6 col-md-8 col-lg-6">
                                                            <input class="text-center padding0"
                                                                   value="{{$shipment->length}}"
                                                                   style="width:100%;" name="length">
                                                        </div>
                                                        <div class="col-xs-1 top">L</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="row">
                                                        <div class="col-xs-8 col-sm-6 col-md-8 col-lg-6">
                                                            <input class="text-center padding0"
                                                                   value="{{$shipment->height}}"
                                                                   style="width:100%;" name="height">
                                                        </div>
                                                        <div class="col-xs-1 top">W</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="row">
                                                        <div class="col-xs-8 col-sm-6 col-md-8 col-lg-6">
                                                            <input class="text-center padding0"
                                                                   value="{{$shipment->width}}"
                                                                   style="width:100%;" name="width">
                                                        </div>
                                                        <div class="col-xs-1 top">D</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-5 padding-tb5">
                                        <div class="col-xs-8 col-lg-4 invoice-address">Order number:</div>
                                        <div class="col-xs-2 col-md-4 col-lg-2 completed-invoice">
                                            <input class="text-center" value="{{$shipment->order_number}}"
                                                   type="text" style="width:100%;" name="order_number">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 padding-tb5 invoice-address"
                                         style="margin-left:15px;">
                                        <a href="{{$shipment->uploaded_file}}" target="_blank">
                                            View invoice
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="new-box">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="row" style="margin-left: 0px;"><h2>Member details</h2></div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="row">
                                    <div class="col-xs-12 padding-tb5">
                                        <div class="row">
                                            <div class="col-xs-5 invoice-address">Member id:</div>
                                            <div class="col-xs-7">
                                                <select id="change-user" style="width: 100%;"
                                                        name="user"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="row">
                                            <div class="col-xs-5 invoice-address">Address:</div>
                                            <div class="col-xs-7 padding-tb5 completed-invoice">
                                                <input value="{{$shipment->delivery_details->address1}}"
                                                       type="text" name="address1">
                                            </div>
                                            <div class="col-xs-7 col-xs-offset-5 padding-tb5 completed-invoice">
                                                <input value="{{$shipment->delivery_details->address2}}"
                                                       type="text" name="address2">
                                            </div>
                                            <div class="col-xs-7 col-xs-offset-5 padding-tb5 completed-invoice">
                                                <input value="{{$shipment->delivery_details->city}}"
                                                       type="text" name="city">
                                            </div>
                                            <div class="col-xs-7 col-xs-offset-5 padding-tb5 completed-invoice">
                                                <input value="{{$shipment->delivery_details->state}}"
                                                       type="text" name="state">
                                            </div>
                                            <div class="col-xs-7 col-xs-offset-5 padding-tb5 completed-invoice">
                                                <input value="{{$shipment->delivery_details->country}}"
                                                       type="text" name="country">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="row">
                                    <div class="col-xs-12 padding-tb5">
                                        <div class="row">
                                            <div class="col-xs-5 invoice-address">First name:</div>
                                            <div class="col-xs-7 completed-invoice">
                                                <input value="{{$shipment->delivery_details->firstname}}"
                                                       type="text" name="firstname">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="row">
                                            <div class="col-xs-5 invoice-address">Last name:</div>
                                            <div class="col-xs-7 completed-invoice">
                                                <input value="{{$shipment->delivery_details->lastname}}"
                                                       type="text" name="lastname">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-details">
                        <div class="row">
                            <div class="col-xs-12 col-lg-7">
                                <div class="row" style="margin-left: 10px;"><h4>Purchase details</h4></div>
                                <table id="data_table" class="table datatable dt-responsive"
                                       style="width:100%; border-bottom:1px solid grey;">
                                    <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Description</th>
                                        <th>Item value</th>
                                        <th>Classification</th>
                                        <th>Classification duty</th>
                                    </tr>
                                    </thead>
                                    <tbody id="items-table-body">
                                    <?php $subTotal = 0; $totalDuty = 0; ?>
                                    @foreach($shipment->items as $index => $item)
                                        <tr>
                                            <td id="item-quantity-td">
                                                <select class="small-select item-quantity"
                                                        name="quantity[{{$index}}]">
                                                    @for($i=1; $i<=10; $i++)
                                                        <option value="{{$i}}"
                                                                @if($item->qty == $i) selected @endif>
                                                            {{$i}}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </td>
                                            <td  id="item-name-td">
                                                <input type="text" value="{{$item->name}}"
                                                       name="name[{{$index}}]"/>
                                            </td>
                                            <td id="item-cost-td">
                                                    <span style="position:relative;">
                                                        $<input type='number' class="item-cost" index="{{$index}}"
                                                                name="cost[{{$index}}]"
                                                                step='0.01' placeholder='0.00' style="display:inline;"
                                                                required
                                                                value="{{$item->cost}}"/>
                                                    </span>
                                            </td>
                                            <td id="item-classification-td">
                                                <select class="small-select classification"
                                                        name="classification[{{$index}}]">
                                                    @foreach($taxes as $tax)
                                                        <option value={{$tax->id}} duty={{$tax->duty}} @if($item->tax->id == $tax->id) selected @endif>
                                                            {{$tax->description}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td id="item-classification-duty-td">
                                                {{$item->tax->duty}}%
                                            </td>
                                        </tr>
                                        <?php $subTotal += $item->qty * $item->cost; ?>
                                        <?php $totalDuty += ($item->qty * $item->cost) * $item->tax->duty / 100; ?>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-xs-4 col-md-8 text-right invoice-address">Subtotal:</div>
                                    <div class="col-xs-8 col-md-4 completed-invoice" id="sub-total">
                                        ${{number_format($subTotal, 2, '.', ',')}}
                                    </div>
                                </div>
                                <div class="row flex">
                                    <div class="col-xs-4 col-md-8 text-right invoice-address">Shipping cost:</div>
                                    <div class="col-xs-8 col-md-4 completed-invoice" id="retailer-shipping-cost">
                                        <div class="row flex">
                                            <div class="col-xs-1" style="align-self:center;">$</div>
                                            <div class="col-xs-10">
                                                <input type="number" name="retailer_shipping_cost"
                                                       id="shipping-cost"
                                                       value="{{number_format($shipment->retailer_shipping_cost, 2, '.', ',')}}"
                                                       step='0.01' placeholder='0.00' style="display:inline;"
                                                       required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row flex">
                                    <div class="col-xs-4 col-md-8 text-right invoice-address">Tax:</div>
                                    <div class="col-xs-8 col-md-4 completed-invoice" id="retailer-tax">
                                        <div class="row flex">
                                            <div class="col-xs-1" style="align-self:center;">$</div>
                                            <div class="col-xs-10">
                                                <input type="number" name="retailer_tax"
                                                       id="shipping-tax"
                                                       value="{{number_format($shipment->retailer_tax, 2, '.', ',')}}"
                                                       step='0.01' placeholder='0.00' style="display:inline;"
                                                       required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 col-md-8 text-right invoice-address">Total shipment value:
                                    </div>
                                    <div class="col-xs-8 col-md-4 total-price-invoice" id="total">
                                        ${{number_format(($subTotal + $shipment->retailer_shipping_cost + $shipment->retailer_tax), 2, '.', ',')}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-1 col-lg-4 grey-box">
                                <h4>
                                    Shipment costs</h4>
                                <div class="row">
                                    <div class="col-xs-8 text-right"><strong>Total duty:</strong></div>
                                    <div class="col-xs-4 text-left" id="total-duty">
                                        ${{number_format($totalDuty, 2, '.', ',')}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-8 text-right"><strong>Total VAT{{ '@' . getSetting('VAT_TAX') }}
                                            %:</strong></div>
                                    <div class="col-xs-4 text-left" id="total-vat">
                                        ${{number_format(getSetting('VAT_TAX') / 100 * $shipment->cost, 2, '.', ',')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-danger">Save changes</button>
                        <a href="{{ url('admin/shipments/'.$shipment->id) }}" class="os-regular size50">Cancel</a>
                    </div>
                </div>
                {{--end main content--}}
            </div>
        </div>
    </form>
    {{--end form--}}
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            /* Update item costs to have 2 decimals. */
            $('.item-cost').each(function () {
                $(this).val(parseFloat($(this).val()).toFixed(2));
            });

            /* Update shipment's costs handler. */
            var updateCosts = function() {
                /* Recalculate costs. */
                var total = 0;
                var subTotal = 0;
                var totalDuty = 0;

                $('.item-quantity').each(function (i) {
                    var quantity = $(this).val();
                    var cost = $(this).parent().parent().find('#item-cost-td').find('input').val();
                    var dutyText = $(this).parent().parent().find('#item-classification-duty-td').html();

                    total += parseInt(quantity) * parseFloat(cost);
                    subTotal += parseInt(quantity) * parseFloat(cost);

                    var taxDuty = dutyText.trim();
                    taxDuty = taxDuty.substring(0, taxDuty.length - 1);
                    totalDuty += parseFloat(quantity) * parseFloat(cost) * (parseFloat(taxDuty) / 100);
                });

                total += parseFloat($('#shipping-cost').val());
                total += parseFloat($('#shipping-tax').val());

                $('#total').html("$" + total.toFixed(2));
                $('#sub-total').html("$" + subTotal.toFixed(2));
                $('#total-duty').html("$" + totalDuty.toFixed(2));
                $('#total-vat').html("$" + (total * parseFloat('{{getSetting('VAT_TAX')}}') / 100).toFixed(2));
            };

            /* Initialize the select with the list of users. */
            var data = <?php echo $users ?>;
            $('#change-user').select2({
                data: data,
                templateResult: function (state) {
                    console.log(state);

                    if (!state.id) {
                        return;
                    }

                    var $state = state.id;
                    return $state;
                },
                templateSelection: function (state) {
                    if (!state.id)
                        return 'Search by member id';

                    return state.id;
                },
                matcher: function (term, text) {
                    if (text.firstname && text.lastname && text.id && term.term) {
                        var _ID = text.id;
                        var _TERM = term.term.toUpperCase();

                        if (_ID.indexOf(_TERM) != -1)
                            return text;

                        return {};
                    }

                    return text;
                }
            }).val(<?php echo $shipment->user->id; ?>).trigger('change');

            $('b[role="presentation"]').hide();
            $('.select2-selection__arrow').append('<i class="fa fa-search search-select" aria-hidden="true"></i>');

            /* Handle items changing and update costs. */
            $('.item-cost').on('change', function () {
                updateCosts();
            });

            /* Handle items quantity changing and update costs. */
            $('.item-quantity').on('change', function () {
                updateCosts();
            });

            /* Handle items classification changing and update costs. */
            $('.classification').on('change', function() {
                $(this).parent().parent().find('#item-classification-duty-td').html($('option:selected', $(this)).attr('duty') + "%");
                updateCosts();
            });

            /* Handle shipping cost. */
            $('#shipping-cost').on('change', function () {
                updateCosts();
            });

            /* Handle shipping tax. */
            $('#shipping-tax').on('change', function () {
                updateCosts();
            });

            $('form').on('submit', function() {
                $('button[type="submit"]').attr('disabled', true);
            });
        })
    </script>
@endsection
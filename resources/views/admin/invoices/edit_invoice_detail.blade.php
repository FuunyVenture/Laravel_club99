@extends('layouts.admin.app')

@section('title', 'Edit invoice')

@section('css')

@endsection

@section('content')
    <div class="content">
        <div class="row">
            {{--header content--}}
            <div class="col-xs-12 back"><a href="{{ url('admin/invoices/'. $invoice->id) }}">
                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a></div>
            <div class="col-xs-12">
                <h3>Edit invoice detail</h3></div>
            {{--end header content--}}
            {{--open form ("edit-invoice-form") --}}
            <form id="edit-invoice-form" method="POST" action="{{url('/admin/invoices/' . $invoice->id)}}">
                {{csrf_field()}}
                {{--main content--}}
                <div class="col-xs-12">
                    <div class="new-box member-inv-border">
                        <div class="row" style="border-bottom: 1px solid #f4f4f4; padding-bottom: 10px;">
                            <div class="col-xs-6 col-md-3">
                                <img
                                        class="svg"
                                        src="{{ asset('assets/dist/img/Club99love-logo-red.svg') }}"
                                        alt=""/>
                            </div>
                            <div class="col-xs-6 col-md-3 invoice-address">
                                <div class="row">
                                    {{isset($invoice->user->home_address->address1) ? $invoice->user->home_address->address1 . ',' : ''}}
                                    {{isset($invoice->user->home_address->address2) ? $invoice->user->home_address->address2 . ',' : ''}}
                                    {{isset($invoice->user->home_address->city) ? $invoice->user->home_address->city . ',' : ''}}
                                </div>
                                <div class="row">
                                    {{isset($invoice->user->home_address->state) ? $invoice->user->home_address->state . ',' : ''}}
                                    {{isset($invoice->user->home_address->zip_code) ? $invoice->user->home_address->zip_code . ',' : ''}}
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 text-right vat">
                                VAT Sales Invoice / VAT Sales Receipt
                            </div>
                        </div>
                        <div class="row" style="padding-top: 10px;">
                            <div class="col-xs-12 col-md-6">
                                <div class="row">
                                    <div class="col-xs-12 os-regular size44">
                                        <div class="row flex-baseline">
                                            <div class="col-xs-2">User:</div>
                                            <div class="col-xs-6">
                                                <h2 id="invoice-user">
                                                    {{$invoice->user->firstname}}
                                                    {{$invoice->user->lastname}}
                                                </h2>
                                            </div>
                                            <div class="col-xs-12">
                                            <span id="mhz" style="display: none;">
                                            <select class="select2" id="change-user" style="width: 100%;" name="user">
                                                <option value=""></option>
                                            </select>
                                            </span>
                                            </div>
                                            <a class="btn" id="view-users-select">Change</a>
                                            <a class="btn" id="cancel-users-select" style="display: none;">Cancel</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 invoice-address" id="address1">
                                        {{isset($invoice->user->bill_address->address1) ? $invoice->user->bill_address->address1 : ''}}
                                    </div>
                                    <div class="col-xs-12 invoice-address" id="address2">
                                        {{isset($invoice->user->bill_address->address2) ? $invoice->user->bill_address->address2 : ''}}
                                    </div>

                                    <div class="col-xs-12 invoice-address" id="city">
                                        {{isset($invoice->user->bill_address->city) ? $invoice->user->bill_address->city : ''}}
                                    </div>
                                    <div class="col-xs-12 invoice-address" id="state">
                                        {{isset($invoice->user->bill_address->state) ? $invoice->user->bill_address->state : ''}}
                                    </div>
                                    <div class="col-xs-12 invoice-address" id="zip_code">
                                        {{isset($invoice->user->bill_address->zip_code) ? $invoice->user->bill_address->zip_code : ''}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="row">
                                    <div class="col-xs-6 text-right invoice-address form-group">Invoice number:</div>
                                    <div class="col-xs-6 completed-invoice form-group">{{$invoice->id}}</div>
                                    <div class="col-xs-6 text-right invoice-address form-group">Invoice date:</div>
                                    <div class="col-xs-6 completed-invoice form-group">
                                        <input
                                                value="{{\Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y')}}"
                                                placeholder="Start date"
                                                id="created_at" name="created_at" required>
                                        {{--{{\Carbon\Carbon::parse($invoice->created_at)->format('d-F-Y')}}--}}
                                    </div>
                                    <div class="col-xs-6 text-right invoice-address form-group">Invoice due date:</div>
                                    <div class="col-xs-6 completed-invoice form-group">
                                        <input
                                                value="{{\Carbon\Carbon::parse($invoice->due_ate)->format('d/m/Y')}}"
                                                placeholder="Start date"
                                                id="due_date" name="due_date" required>
                                        {{--{{\Carbon\Carbon::parse($invoice->due_date)->format('d-F-Y')}}--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="data_table" class="table datatable dt-responsive"
                               style="width:100%;margin-left: -10px;border-bottom: 1px solid #f4f4f4;">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Duty cost</th>
                                <th>Tax</th>
                                <th>Price</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody id="products-table-body">
                            <?php $subTotal = 0; $totalVat = 0; ?>
                            @foreach($invoice->products as $product)
                                <tr>
                                    <td>
                                        <select class="product-option" name="products[]">
                                            <optgroup label="Packages" class="packages-group">
                                                @foreach($packages as $package)
                                                    <option value="{{$package->product->id}}" type="package"
                                                            price="{{number_format(($package->cost), 2, '.', ',')}}"
                                                            @if($product->type == 'package' && $product->package_id == $package->id)
                                                            selected
                                                            @endif
                                                    >
                                                        {{$package->name}}
                                                    </option>
                                                @endforeach
                                            </optgroup>

                                            <optgroup label="Fees" class="fees-group">
                                                @if($product->type == 'fee' && $product->fee->archived = 1)
                                                    <option value="{{$product->fee->product->id}}" type="fee"
                                                            price="{{number_format($product->fee->cost, 2, '.', ',')}}"
                                                            taxable="{{$product->fee->taxable}}"
                                                            selected>
                                                        {{$product->fee->name}}
                                                    </option>
                                                @endif
                                                @foreach($fees as $fee)
                                                    @if(!($product->type == 'fee' && $product->fee->archived == 1 && $product->fee->id == $fee->id))
                                                        <option value="{{$fee->product->id}}" type="fee"
                                                                price="{{number_format($fee->cost, 2, '.', ',')}}"
                                                                taxable="{{$fee->taxable}}"
                                                                @if($product->type == 'fee' && $product->fee->id == $fee->id) selected @endif>
                                                            {{$fee->name}}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </optgroup>

                                            <optgroup label="Shipments" class="shipments-group">
                                                @foreach($shipments as $shipment)
                                                    @if($shipment->user->id == $invoice->user->id)
                                                        <option value="{{$shipment->product->id}}" type="shipment"
                                                                price="{{number_format(($shipment->duty_cost + $shipment->duty_tax), 2, '.', ',')}}"
                                                                dutyCost="{{number_format($shipment->duty_cost, 2, '.', ',')}}"
                                                                tax="{{number_format($shipment->duty_tax, 2, '.', ',')}}"
                                                                @if($product->type == 'shipment' && $product->shipment_id == $shipment->id)
                                                                selected
                                                                @endif
                                                        >
                                                            {{$shipment->name}}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </td>
                                    <td id="view-duty-cost">
                                        @if($product->type == 'shipment')
                                            ${{number_format($product->shipment->duty_cost, 2, '.', ',')}}
                                        @endif
                                        {{--${{number_format($item->tax->duty, 2, '.', ',')}}--}}
                                    </td>
                                    <td id="view-tax">
                                        @if($product->type == 'shipment')
                                            ${{number_format($product->shipment->duty_tax, 2, '.', ',')}}
                                        @endif
                                        {{--${{number_format(7.5 / 100 * $item->tax->duty, 2, '.', ',')}}--}}
                                    </td>
                                    <td id="view-price">
                                        @if($product->type == 'shipment')
                                            ${{number_format(($product->shipment->duty_cost + $product->shipment->duty_tax), 2, '.', ',')}}
                                        @elseif($product->type == 'fee')
                                            ${{number_format($product->fee->cost, 2, '.', ',')}}
                                        @elseif($product->type == 'package')
                                            ${{number_format($product->package->cost, 2, '.', ',')}}
                                        @else
                                            ${{number_format(($product->coupon->type == 'percentage' ? (0 - ($product->coupon->value / 100) * $invoice->total) : (0 - $product->coupon->value)), 2, '.', ',')}}
                                        @endif
                                        {{--${{number_format($item->tax->duty + 7.5 / 100 * $item->tax->duty, 2, '.', ',')}}--}}
                                    </td>
                                    <td>
                                        <i class="glyphicon glyphicon-trash" style="color:red; margin-left:10px;"></i>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row add-product">
                            <a class="btn btn-edit" id="add-other-product">+ Add another product</a>
                        </div>
                        <div class="row">
                            <div class="col-xs-10 text-right os-bold size44">Sub total:</div>
                            <div class="col-xs-2 os-regular size44" id="sub-total">
                                ${{number_format($subTotal, 2, '.', ',')}}</div>
                        </div>
                        <div class="row">
                            <div class="col-xs-10 text-right os-bold size44">Total VAT{{ '@'. getSetting('VAT_TAX') }}
                                %:
                            </div>
                            <div class="col-xs-2 os-regular size44" id="vat-total">
                                ${{number_format($totalVat, 2, '.', ',')}}</div>
                        </div>
                        <div class="row">
                            <div class="col-xs-10 text-right os-bold size44">Total due:</div>
                            <div class="col-xs-2 total-price">
                                <strong id="due-total">${{number_format($subTotal + $totalVat, 2, '.', ',')}}</strong>
                            </div>
                        </div>
                    </div>
                </div>
                {{--end main content--}}
                {{--footer content--}}
                <div class="row">
                    <div class="col-xs-12 text-right">
                        <a class="btn" href="{{url('/admin/invoices/' . $invoice->id)}}">Cancel</a>
                        <button class="btn btn-primary" type="submit">Save invoice</button>
                    </div>
                </div>
                {{--end footer content--}}
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var preventChangeUserEvent = true;

        $(document).ready(function () {
            /* Initialize attributes. */
            var selectedShipments = [], x = [];

            $('#created_at').datepicker({
                format: "dd/mm/yyyy"
            }).on('changeDate', function (selected) {
                startDate = new Date(selected.date.valueOf());
                startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
                $('#due_date').datepicker('setStartDate', startDate);
            });
            $('#due_date').datepicker({
                format: "dd/mm/yyyy"
            });

            /* Update invoice total costs function. */
            var updateInvoiceTotals = function () {
                var subTotal = 0;
                var totalVat = 0;

                $.each($('.product-option'), function () {
                    if ($('option:selected', this).attr('type') == 'fee')
                        subTotal += parseFloat($('option:selected', this).attr('price'));
                    else if ($('option:selected', this).attr('type') == 'shipment')
                        subTotal += parseFloat($('option:selected', this).attr('dutyCost')) + parseFloat($('option:selected', this).attr('tax'));
                    else if ($('option:selected', this).attr('type') == 'package') {
                        subTotal += parseFloat($('option:selected', this).attr('price').replace(',', ''));
                    }

                    if ($('option:selected', this).attr('type') == 'fee' &&
                            $('option:selected', this).attr('taxable') == 'taxable') {
                        totalVat += parseFloat($('option:selected', this).attr('price'));
                    }
                });

                $('#sub-total').html("$" + subTotal.toFixed(2));
                $('#vat-total').html("$" + ({{getSetting('VAT_TAX')}} / 100 * totalVat).toFixed(2)
                )
                ;
                $('#due-total').html("$" + (subTotal + ({{getSetting('VAT_TAX')}} / 100 * totalVat)).toFixed(2)
                )
                ;
            };
            updateInvoiceTotals();

            /* Parse all products and add selected shipments to 'selectedShipments' list. */
            $('.product-option').each(function () {
                if ($('option:selected', this).attr('type') == 'shipment') {
                    selectedShipments.push(parseInt($('option:selected', this).attr('value')));
                    selectedShipments.sort(function (a, b) {
                        return a - b;
                    });

                    x.push(parseInt($('option:selected', this).attr('value')));
                    x.sort(function (a, b) {
                        return a - b;
                    });
                }
            });

            /* Parse all products and hide aready selected shipments. */
            $('.product-option').each(function () {
                $('option', this).each(function () {
                    if ($(this).attr('type') == 'shipment')
                        if (selectedShipments.indexOf(parseInt($(this).attr('value'))) > -1)
                            $(this).prop('hidden', true);
                })
            });

            /* Initialize user's list. */
            var data = <?php echo $users ?>;

            /* Initialize user's select2 dropdown. */
            $('#change-user').select2({
                data: data,
                templateResult: function (state) {
                    if (!state.id) {
                        return;
                    }

                    var $state = $(
                            '<div class="row">' +
                            '<div class="col-xs-6 text-left">' + state.firstname + ' ' + state.lastname + '</div>' +
                            '<div class="col-xs-6 text-left">' + state.id + '</div>' +
                            '</div>'
                    );
                    return $state;
                },
                templateSelection: function (state) {
                    if (!state.id)
                        return 'Search by name or member id';

                    return state.firstname + ' ' + state.lastname;
                },
                matcher: function (term, text) {
                    if (text.firstname && text.lastname && text.id && term.term) {
                        var _ID = text.id;
                        var _NAME = text.firstname.toUpperCase() + " " + text.lastname.toUpperCase();
                        var _TERM = term.term.toUpperCase();

                        if (_NAME.indexOf(_TERM) != -1 || _ID.indexOf(_TERM) != -1)
                            return text;

                        return {};
                    }

                    return text;
                }
            });
            $('b[role="presentation"]').hide();
            $('.select2-selection__arrow').append('<i class="fa fa-search search-select" aria-hidden="true"></i>');

            /* Get new selected user's shipments from server. */
            $('#change-user').on('change', function () {
                if (!preventChangeUserEvent) {
                    $.ajax({
                        type: "GET",
                        url: '{{url('/admin/shipments/getByUser')}}',
                        headers: {
                            'X-CSRF-Token': '{{csrf_token()}}'
                        },
                        data: {
                            user_id: $(this).val()
                        },
                        async: false,
                        success: function (response) {
                            console.log('change invoice user success', response);

                            selectedShipments = [];

                            $('.product-option').find('.shipments-group').empty();
                            $.each(response.shipments, function () {
                                $('<option value="' + this.product.id + '" type="shipment" dutyCost="' + this.duty_cost + '" tax="' + this.duty_tax + '" price="' + this.cost + '">' + this.name + '</option>').appendTo($('.product-option').find('.shipments-group'));
                            });

                            /* Update address. */
                            if(response.user.bill_address) {
                                $('#address1').html(response.user.bill_address.address1);
                                $('#address2').html(response.user.bill_address.address2);
                                $('#city').html(response.user.bill_address.city);
                                $('#state').html(response.user.bill_address.state);
                                $('#zip_code').html(response.user.bill_address.zip_code);
                            } else {
                                $('#address1').html("");
                                $('#address2').html("");
                                $('#city').html("");
                                $('#state').html("");
                                $('#zip_code').html("");
                            }
                        },
                        error: function (response) {
                            console.log('change invoice user error', response);
                        }
                    });

                    $.each(<?php echo $users; ?>, function () {
                        if (this.id == $('#change-user').val())
                            $('#invoice-user').html(this.firstname + ' ' + this.lastname);
                    });

                    $('#invoice-user').show();
                    $('#mhz').hide();
                    $('#view-users-select').show();
                    $('#cancel-users-select').hide();
                } else {
                    preventChangeUserEvent = false;
                }
            });
            $("#change-user").val("{{$invoice->user->id}}").trigger("change");

            $('#view-users-select').on('click', function () {
                $('#mhz').show();
                $('#invoice-user').hide();
                $('#cancel-users-select').show();
                $(this).hide();
            });

            $('#cancel-users-select').on('click', function () {
                $('#mhz').hide();
                $('#invoice-user').show();
                $('#view-users-select').show();
                $(this).hide();
            });

            /* Add new product handler. */
            $('#add-other-product').on('click', function () {
                var stringEl = '<tr>';
                stringEl += '<td>';
                stringEl += '<select class="product-option" name="products[]">';
                stringEl += '<option disabled selected>Select a product</option>';

                stringEl += '<optgroup label="Packages" class="packages-group">';
                @foreach($packages as $package)
                        stringEl += '<option value="{{$package->product->id}}" type="package" price="{{number_format($package->cost, 2, '.', ',')}}">';
                stringEl += '{{$package->name}}';
                stringEl += '</option>';
                @endforeach
                        stringEl += '</optgroup>';

                stringEl += '<optgroup label="Fees" class="fees-group">';
                @foreach($fees as $fee)
                        stringEl += '<option value="{{$fee->product->id}}" type="fee" price="{{number_format($fee->cost, 2, '.', ',')}}">';
                stringEl += '{{$fee->name}}';
                stringEl += '</option>';
                @endforeach
                        stringEl += '</optgroup>';

                stringEl += '<optgroup label="Shipments" class="shipments-group">';
                $.ajax({
                    type: "GET",
                    url: '{{url('/admin/shipments/getByUser')}}',
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    },
                    data: {
                        user_id: $('#change-user').val()
                    },
                    async: false,
                    success: function (response) {
                        console.log('add another product success', response);

                        $.each(response.shipments, function () {
                            stringEl += '<option value="' + this.product.id + '" type="shipment" dutyCost="' + this.duty_cost.toFixed(2) + '" tax="' + this.duty_tax.toFixed(2) + '" price="' + this.cost.toFixed(2) + '"';
                            if (selectedShipments.indexOf(this.product.id) > -1) {
                                stringEl += ' hidden';
                            }
                            stringEl += '>';
                            stringEl += this.name;
                            stringEl += '</option>';
                        });
                    },
                    error: function (response) {
                        console.log('add another product error', response);
                    }
                });

                stringEl += '</optgroup>';
                stringEl += '</select>';
                stringEl += '</td>';
                stringEl += '<td id="view-duty-cost"></td>';
                stringEl += '<td id="view-tax"></td>';
                stringEl += '<td id="view-price"></td>';
                stringEl += '<td><i class="glyphicon glyphicon-trash" style="color:red; margin-left:10px;"></i></td>';
                stringEl += '</tr>';

                $(stringEl).appendTo('#products-table-body');

                resetProductSelectorEvent();
                resetProductDeleteEvent();
            });

            /* Update 'selectedShipments' list and hide/show selected/unselected shipment options. */
            var resetProductSelectorEvent = function () {
                $('.product-option').off();
                $('.product-option').on('change', function () {
                    /*Update row*/
                    $(this).parent().parent().find('#view-price').html("$" + $('option:selected', this).attr('price'));

                    if ($('option:selected', this).attr('type') == 'fee') {
                        $(this).parent().parent().find('#view-duty-cost').empty();
                        $(this).parent().parent().find('#view-tax').empty();
                    } else if ($('option:selected', this).attr('type') == 'shipment') {
                        $(this).parent().parent().find('#view-duty-cost').html("$" + $('option:selected', this).attr('dutyCost'));
                        $(this).parent().parent().find('#view-tax').html("$" + $('option:selected', this).attr('tax'));
                    }

                    $(this).parent().parent().find('#view-price').html("$" + $('option:selected', this).attr('price'));

                    updateInvoiceTotals();

                    /*Add option to selected options*/
                    if ($('option:selected', this).attr('type') == 'shipment') {
                        selectedShipments.push(parseInt($(this).val()));
                        selectedShipments.sort(function (a, b) {
                            return a - b;
                        });
                    }

                    /*Mark all selected options as disabled*/
                    $('.product-option').each(function () {
                        $('option', this).each(function () {
                            if ($(this).attr('type') == 'shipment') {
                                if (selectedShipments.indexOf(parseInt($(this).attr('value'))) != -1) {
                                    $(this).prop('hidden', true);
                                }
                            }
                        })
                    });

                    x = [];
                    $('.product-option').each(function () {
                        if ($('option:selected', this).attr('type') == 'shipment') {
                            x.push(parseInt($('option:selected', this).attr('value')));
                            x.sort(function (a, b) {
                                return a - b;
                            });
                        }
                    });

                    var c = false;
                    for (var i = 0; i < x.length; i++) {
                        if (x[i] > selectedShipments[i]) {
                            $('.product-option').each(function () {
                                $('option', this).each(function () {
                                    if ($(this).attr('value') == selectedShipments[i])
                                        $(this).prop('hidden', false);
                                })
                            });

                            selectedShipments.splice(i, 1);

                            c = true;
                        }
                    }

                    if (!c && selectedShipments.length > x.length) {
                        $('.product-option').each(function () {
                            $('option', this).each(function () {
                                if ($(this).attr('value') == selectedShipments[selectedShipments.length - 1])
                                    $(this).prop('hidden', false);
                            })
                        });
                        selectedShipments.splice(selectedShipments.length - 1, 1);
                    }
                });
            };
            resetProductSelectorEvent();

            /* Handle delete icon click event. */
            var resetProductDeleteEvent = function () {
                $('.glyphicon-trash').off();
                $('.glyphicon-trash').on('click', function () {
                    /*Restore hidden shipment if it's selected*/
                    if ($('option:selected', $(this).parent().parent().find('.product-option')).attr('type') == 'shipment') {
                        var productId = $(this).parent().parent().find('.product-option').val();
                        selectedShipments.splice(productId, 1);

                        $('.product-option').each(function () {
                            $('option', this).each(function () {
                                $(this).prop('hidden', false);
                            })
                        })
                    }

                    /*Remove row from table*/
                    $(this).parent().parent().remove();

                    updateInvoiceTotals();
                })
            };
            resetProductDeleteEvent();

            /* Submit form handler. */
            $('#edit-invoice-form').on('submit', function (e) {
                e.preventDefault();

                $(this).validate({
                    errorPlacement: function (error, element) {
                        if (element.attr("name") == "user") {
                            element.parent().append(error);
                        } else {
                            element.parent().append(error);
                        }
                    }
                });

                if ($(this).valid()) {
                    $.ajax({
                        type: "POST",
                        url: '{{url('/admin/invoices/' . $invoice->id . '/update')}}',
                        data: $('#edit-invoice-form').serialize(),
                        async: false,
                        success: function (response) {
                            console.log('create invoice user select', response);
                            window.location.href = '{{url('admin/invoices')}}';
                        },
                        error: function (response) {
                            console.log('create invoice user select', response);
                        }
                    });
                }
            });

            $('form').on('submit', function() {
                $('button[type="submit"]').attr('disabled', true);
            })
        })
    </script>

@endsection
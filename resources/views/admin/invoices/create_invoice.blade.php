@extends('layouts.admin.app')

@section('title', 'Create invoice')

@section('css')

@endsection

@section('content')
    <div class="content">
        <div class="row">
            {{--header content--}}
            <div class="col-xs-12 back"><a href="{{ url('admin/invoices') }}">
                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a></div>
            <div class="col-xs-12">
                <h3>
                    Create invoice
                </h3>
            </div>
            {{--end header content--}}
            {{-- open form to edit a invoice--}}
            <form id="create-invoice-form" method="POST" action="{{url('/admin/invoices')}}" novalidate>
                {{csrf_field()}}
                {{--main content--}}
                <div class="col-xs-12">
                    <div class="new-box">
                        <div class="row" style="padding-top: 10px;">
                            <div class="col-xs-12 col-md-6">
                                <div class="row">
                                    <div class="col-xs-12" id="user-select">
                                        <span class="invoice-address">User:</span>
                                        <select id="change-user" style="width: 50%;" name="user" required>
                                            <option value=""></option>
                                        </select>
                                    </div>

                                    <div class="col-xs-12 invoice-address">
                                        Address 1
                                    </div>
                                    <div class="col-xs-12 invoice-address">
                                        Address 2
                                    </div>
                                    <div class="col-xs-12 invoice-address">
                                        City
                                    </div>
                                    <div class="col-xs-12 invoice-address">
                                        State
                                    </div>
                                    <div class="col-xs-12 invoice-address">
                                        Zip code
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="row">
                                    {{--<div class="col-xs-6 text-right">Invoice number:</div>
                                    <div class="col-xs-6"><strong>12345</strong></div>--}}
                                    <div class="col-xs-6 text-right invoice-address">Invoice date:</div>
                                    <div class="col-xs-6 completed-invoice">
                                        {{\Carbon\Carbon::now()->format('d F Y')}}
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
                            <tr>
                                <td>
                                    <select class="product-option" name="products[0]" required>
                                        <option value="" disabled selected>Select product</option>
                                        <optgroup label="Fees" class="fees-group">
                                            @foreach($fees as $fee)
                                                <option value="{{$fee->product->id}}" type="fee"
                                                        taxable="{{$fee->taxable}}"
                                                        price="{{number_format($fee->cost, 2, '.', ',')}}">
                                                    {{$fee->name}}
                                                </option>
                                            @endforeach
                                        </optgroup>

                                        <optgroup label="Shipments" class="shipments-group">
                                            @if(session('userId') && session('shipmentId'))
                                                @foreach(session('userShipments') as $shipment)
                                                    <option value="{{$shipment->product->id}}" type="shipment"
                                                            dutyCost="{{number_format($shipment->duty_cost, 2, '.', ',')}}"
                                                            tax="{{number_format($shipment->duty_tax, 2, '.', ',')}}"
                                                            price="{{number_format($shipment->duty_cost + $shipment->duty_tax, 2, '.', ',')}}"
                                                            @if($shipment->id == session('shipmentId')) selected @endif>
                                                        {{$shipment->name}}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="noUser" disabled>Please select a user</option>
                                            @endif
                                            {{--@foreach($shipments as $shipment)
                                                @if($shipment->user->id == $shipment->user->id)
                                                    <option value="{{$shipment->product->id}}" type="shipment"
                                                            price="{{number_format($shipment->cost, 2, '.', ',')}}"
                                                            dutyCost="{{number_format($shipment->duty_cost, 2, '.', ',')}}"
                                                            tax="{{number_format($shipment->tax, 2, '.', ',')}}">
                                                        {{$shipment->name}}
                                                    </option>
                                                @endif
                                            @endforeach--}}
                                        </optgroup>
                                    </select>
                                </td>
                                <td id="view-duty-cost">
                                    @if(session('userId') && session('shipmentId'))
                                        @foreach(session('userShipments') as $shipment)
                                            @if(session('shipmentId') == $shipment->id)
                                                ${{number_format($shipment->duty_cost, 2, '.', ',')}}
                                            @endif
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td id="view-tax">
                                    @if(session('userId') && session('shipmentId'))
                                        @foreach(session('userShipments') as $shipment)
                                            @if(session('shipmentId') == $shipment->id)
                                                ${{number_format($shipment->duty_tax, 2, '.', ',')}}
                                            @endif
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td id="view-price">
                                    @if(session('userId') && session('shipmentId'))
                                        @foreach(session('userShipments') as $shipment)
                                            @if(session('shipmentId') == $shipment->id)
                                                ${{number_format($shipment->duty_cost + $shipment->duty_tax, 2, '.', ',')}}
                                            @endif
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <i class="glyphicon glyphicon-trash" style="color:red; margin-left:10px;"></i>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="row add-product">
                            <a class="btn btn-edit" id="add-other-product">+ Add another product</a>
                        </div>
                        <div class="row completed-invoice">
                            <div class="col-xs-10 text-right">Sub total:</div>
                            <div class="col-xs-2" id="sub-total">N/A</div>
                        </div>
                        <div class="row completed-invoice">
                            <div class="col-xs-10 text-right">Total VAT{{ '@'.getSetting('VAT_TAX') }}%:</div>
                            <div class="col-xs-2" id="vat-total">N/A</div>
                        </div>
                        <div class="row">
                            <div class="col-xs-10 text-right completed-invoice">Total due:</div>
                            <div class="col-xs-2 vat">
                                <strong id="due-total">N/A</strong></div>
                        </div>
                    </div>
                </div>
                {{--end main content--}}
                {{--footer content--}}
                <div class="col-xs-12 text-right">
                    <a class="btn" href="{{url('/admin/invoices/')}}">Cancel</a>
                    <button class="btn btn-primary" type="submit">Save invoice</button>
                </div>
                {{--end footer content--}}
            </form>
            {{--close form--}}
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            /* Initialize attributes. */
            var selectedShipments = [],
                    x = [],
                    preventDefault = @if(session('userId') && session('shipmentId')) true
            @else false @endif;

            /* Update invoice total costs function. */
            var updateInvoiceTotals = function () {
                var subTotal = 0;
                var totalVat = 0;

                $.each($('.product-option'), function () {
                    if ($('option:selected', this).attr('type') == 'fee') {
                        subTotal += parseFloat($('option:selected', this).attr('price'));
                    }
                    else if ($('option:selected', this).attr('type') == 'shipment') {
                        subTotal += parseFloat($('option:selected', this).attr('dutyCost')) + parseFloat($('option:selected', this).attr('tax'));
                    }


                    if ($('option:selected', this).attr('type') == 'fee' &&
                            $('option:selected', this).attr('taxable') == 'taxable') {
                        totalVat += parseFloat($('option:selected', this).attr('price'));
                    }
                });

                $('#sub-total').html("$" + subTotal.toFixed(2));
                $('#vat-total').html("$" + (parseFloat('{{getSetting('VAT_TAX')}}') / 100 * totalVat).toFixed(2));
                $('#due-total').html("$" + (subTotal + (parseFloat('{{getSetting('VAT_TAX')}}') / 100 * totalVat)).toFixed(2));
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

            /* Get new selected user's shipments from server. */
            $('#change-user').on('change', function () {
                if (!preventDefault) {
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

                            if (response.shipments.length > 0)
                                $.each(response.shipments, function () {
                                    $('<option value="' + this.product.id + '" type="shipment" dutyCost="' + this.duty_cost.toFixed(2) + '" tax="' + this.duty_tax.toFixed(2) + '" price="' + this.cost.toFixed(2) + '">' +
                                            this.name +
                                            '</option>').appendTo($('.product-option').find('.shipments-group'));
                                });
                            else
                                $(
                                        '<option value="noShipment" disabled>There are no shipments</option>'
                                ).appendTo($('.product-option').find('.shipments-group'));

                            /*Complete address*/
                            $('#user-select').siblings().remove();
                            $('#user-select').after($('<div/>', {
                                html: response.user.bill_address.zip_code,
                                class: 'col-xs-12 invoice-address'
                            })).after($('<div/>', {
                                html: response.user.bill_address.state,
                                class: 'col-xs-12 invoice-address'
                            })).after($('<div/>', {
                                html: response.user.bill_address.city,
                                class: 'col-xs-12 invoice-address'
                            })).after($('<div/>', {
                                html: response.user.bill_address.address2,
                                class: 'col-xs-12 invoice-address'
                            })).after($('<div/>', {
                                html: response.user.bill_address.address1,
                                class: 'col-xs-12 invoice-address'
                            }))
                        },
                        error: function (response) {
                            console.log('change invoice user error', response);
                        }
                    });
                } else
                    preventDefault = false;
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
            })@if(session('userId') && session('shipmentId')).val(<?php echo session('userId'); ?>).trigger('change')@endif;
            $('b[role="presentation"]').hide();
            $('.select2-selection__arrow').append('<i class="fa fa-search search-select" aria-hidden="true"></i>');

            var counter = 1;

            /* Add new product handler. */
            $('#add-other-product').on('click', function () {
                var stringEl = '<tr>';
                stringEl += '<td>';
                stringEl += '<select class="product-option" name="products[' + counter + ']" required>';
                stringEl += '<option disabled selected>Select a product</option>';

                stringEl += '<optgroup label="Fees" class="fees-group">';
                @foreach($fees as $fee)
                        stringEl += '<option value="{{$fee->product->id}}" type="fee" taxable="{{$fee->taxable}}" price="{{number_format($fee->cost, 2, '.', ',')}}">';
                stringEl += '{{$fee->name}}';
                stringEl += '</option>';
                @endforeach
                        stringEl += '</optgroup>';

                stringEl += '<optgroup label="Shipments" class="shipments-group">';

                if ($('#change-user').val() != '') {
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

                            if (response.shipments.length > 0)
                                $.each(response.shipments, function () {
                                    stringEl += '<option value="' + this.product.id + '" type="shipment" dutyCost="' + this.duty_cost.toFixed(2) + '" tax="' + (this.duty_tax).toFixed(2) + '" price="' + this.cost.toFixed(2) + '"';
                                    if (selectedShipments.indexOf(this.product.id) > -1) {
                                        stringEl += ' hidden';
                                    }
                                    stringEl += '>';
                                    stringEl += this.name;
                                    stringEl += '</option>';
                                });
                            else {
                                stringEl += '<option value="noShipment" disabled>There are no shipments</option>';
                            }
                        },
                        error: function (response) {
                            console.log('add another product error', response);
                        }
                    });
                } else {
                    stringEl += '<option value="noUser" disabled>Please select a user</option>'
                }

                stringEl += '</optgroup>';
                stringEl += '</select>';
                stringEl += '</td>';
                stringEl += '<td id="view-duty-cost">N/A</td>';
                stringEl += '<td id="view-tax">N/A</td>';
                stringEl += '<td id="view-price">N/A</td>';
                stringEl += '<td><i class="glyphicon glyphicon-trash" style="color:red; margin-left:10px;"></i></td>';
                stringEl += '</tr>';

                $(stringEl).appendTo('#products-table-body');

                resetProductSelectorEvent();
                resetProductDeleteEvent();

                counter++;
            });

            /* Update 'selectedShipments' list and hide/show selected/unselected shipment options. */
            var resetProductSelectorEvent = function () {
                $('.product-option').off();
                $('.product-option').on('change', function () {
                    /* Update row */
                    if ($('option:selected', this).attr('type') == 'fee')
                        $(this).parent().parent().find('#view-price').html("$" + $('option:selected', this).attr('price'));
                    else
                        $(this).parent().parent().find('#view-price').html("$" + (parseFloat($('option:selected', this).attr('dutyCost')) + parseFloat($('option:selected', this).attr('tax'))).toFixed(2));

                    if ($('option:selected', this).attr('type') == 'fee') {
                        $(this).parent().parent().find('#view-duty-cost').empty();
                        $(this).parent().parent().find('#view-tax').empty();
                    } else if ($('option:selected', this).attr('type') == 'shipment') {
                        $(this).parent().parent().find('#view-duty-cost').html("$" + $('option:selected', this).attr('dutyCost'));
                        $(this).parent().parent().find('#view-tax').html("$" + $('option:selected', this).attr('tax'));
                    }

                    updateInvoiceTotals();

                    /* Add option to selected options */
                    if ($('option:selected', this).attr('type') == 'shipment') {
                        selectedShipments.push(parseInt($(this).val()));
                        selectedShipments.sort(function (a, b) {
                            return a - b;
                        });
                    }

                    /* Mark all selected options as disabled */
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

                    /* Remove row from table */
                    $(this).parent().parent().remove();

                    updateInvoiceTotals();
                })
            };

            /* Submit form handler. */
            $('#create-invoice-form').on('submit', function (event) {
                event.preventDefault();

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
                        url: '{{url('/admin/invoices')}}',
                        headers: {
                            'X-CSRF-Token': '{{csrf_token()}}'
                        },
                        data: $('#create-invoice-form').serialize(),
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
            })
        })
    </script>

@endsection
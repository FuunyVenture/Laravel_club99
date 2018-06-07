{{--A shipment is a collection of items. A shipment is added by a member.
    This view generate a GUI for the admin dashboard with a list of shipments added by all members.--}}

@extends('layouts.admin.app')

@section('title', 'Shipments')

@section('css')
    {!! Html::style('assets/dist/css/ionicons.min.css') !!}

    {!! Html::style('assets/dist/css/wizardAdmin.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTables.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/responsive.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTablesCustom.css') !!}

    {!! Html::style('assets/dist/css/jquery.steps.css') !!}
@endsection

@section('content')
    <section class="content">
        {{--content header--}}
        <div class="page-head-line">
            <span>Shipments</span>
            <span id="add-new-shipment-btn" class="btn btn-primary message_box text-danger" 
                  data-box="#message-box-add" data-action="Add"
                  title="Add">+ Add a shipment
            </span>
        </div>
        {{--end content header--}}
        {{--main content-list of shipments details--}}
        <div class="table-search-filter">
            <div class="col-xs-12 col-sm-3"><h4>My shipments</h4></div>

            <div class="col-xs-12 col-sm-9 filter-search text-right">

                <span>Filter by</span>
                <span class="dropdown">
                    <select class="minimal" id="filter-shipments">
                        <option value="default" selected>All</option>
                        <optgroup label="Status">
                            @foreach($shipmentStatusMap as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Sender">
                            @foreach($retailers as $retailer)
                                <option value="{{$retailer->name}}">
                                    {{$retailer->name}}
                                </option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Order number">
                            @foreach($shipments as $shipment)
                                @if($shipment->order_number != null)
                                    <option value="{{$shipment->order_number}}">
                                        {{$shipment->order_number}}
                                    </option>
                                @endif
                            @endforeach
                        </optgroup>
                    </select>
                </span>
                <span>Search</span>
                <span><input type="text" id="shipmentsInput"></span>
            </div>
        </div>

        <table id="shipments-table" class="table datatable dt-responsive" style="width:100%;">
            <thead>
            <tr>
                <th>ShipmentID</th>
                <th>MemberID</th>
                <th>Member Name</th>
                <th>Shipment Invoice</th>
                <th>Sender</th>
                <th>Total value</th>
                <th>Total duty</th>
                <th>Total Vat</th>
                <th>Ready for pickup</th>
                <th>Date collected</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <div class="table-bottom-border"></div>
        {{--end main content--}}
    </section>

    @include('admin.shipments.add_shipment')
@endsection

@section('js')
    <!-- DataTables -->
    {!! Html::script('assets/dist/js/datatable/jquery.dataTables.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/dataTables.bootstrap.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/dataTables.responsive.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/responsive.bootstrap.min.js') !!}

    {!! Html::script('assets/dist/js/jquery.steps.js') !!}


    <script>
        /* Serialize form fields to json object. */
        $.fn.serializeObject = function () {
            var o = {};
            var a = this.serializeArray();
            $.each(a, function () {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };

        /* Shipments managing after the DOM loads. */
        $(document).ready(function () {
            /* Add new rule to validator */
            $.validator.addMethod(
                    "regex",
                    function (value, element, regexp) {
                        var re = new RegExp(regexp);
                        return this.optional(element) || re.test(value);
                    },
                    "URL format is not valid."
            );

            $('#add-new-shipment-btn').click(function(){
                document.body.style.overflowY = "hidden";

            });

            $('#close-wizard').click(function(){
                document.body.style.overflowY = "visible";
                resetWizard();
            });

            /* Hide the table with shipments. */
            $('#item-table').hide();

            /* Process needed variables */
            var editMode = false, editId, data = {
                items: [],
                shipping_amount: 0,
                tax_amount: 0
            }, errors;

            /* Restore add new item form's fields function. */
            var restoreAddNewItemFormFields = function () {
                $('#add-new-item-form').find('select[name="quantity"]').val('1');
                $('#add-new-item-form').find('input[name="description"]').val('');
                $('#add-new-item-form').find('input[name="cost"]').val('');
                $('#change-tax').select2('val', '');
                $('#duty').html("0%");
                $('#duty-cost').html("$0.00");
                $('.selectpicker').selectpicker('refresh');
            };

            /* Get shipment subtotal function. */
            var getShipmentSubtotal = function () {
                var total = 0;

                $.each(data.items, function () {
                    total += this.quantity * this.cost;
                });

                return total;
            };

            /* Get shipment total duty function. */
            var getShipmentDuty = function () {
                var total = 0;

                $.each(data.items, function () {
                    total += parseFloat(this.duty_cost.substring(1));
                });

                return total;
            };

            /* Delete an existing item function */
            var deleteItemHandler = function () {
                if (!editMode) {
                    var removeId = parseInt($(this).attr('id').split("-")[$(this).attr('id').split("-").length - 1]);
                    var removeIndex = undefined;

                    $.each(data.items, function () {
                        if (removeIndex != undefined) {
                            $('tr#item-' + this.id).attr('id', 'item-' + (this.id - 1));
                            $('#edit-item-' + this.id).attr('id', 'edit-item-' + (this.id - 1));
                            $('#delete-item-' + this.id).attr('id', 'delete-item-' + (this.id - 1));

                            this.id = this.id - 1;
                        }

                        if (this.id == removeId && removeIndex == undefined) {
                            removeIndex = data.items.indexOf(this);
                            $('tr#item-' + this.id).remove();
                        }
                    });
                    data.items.splice(removeIndex, 1);
                    $('#new-item').html('Item ' + (data.items.length + 1 )+ ': ');

                    if (data.items.length == 0) {
                        $('#item-table').hide();
                        $('#no-items-added').show();
                    }
                }
            };

            /* Edit an existing item function */
            var editItemHandler = function () {
                if (!editMode) {
                    editMode = true;

                    var item;
                    editId = parseInt($(this).attr('id').split("-")[$(this).attr('id').split("-").length - 1]);

                    $.each(data.items, function () {
                        if (this.id == editId) {
                            item = this;
                            return;
                        }
                    });

                    if (item) {
                        $('#add_new_item').find('span').text('Save');
                        $('#cancel-item-edit').show();

                        /*Update view with edit details*/
                        $('#add-new-item-form').find('select[name="quantity"]').val(item.quantity);
                        $('#add-new-item-form').find('input[name="description"]').val(item.description);
                        $('#add-new-item-form').find('input[name="cost"]').val(item.cost);
                        $('#change-tax').select2('val', item.tax);
                        $('#duty').html(item.duty);
                        $('#duty-cost').html(item.duty_cost);
                        $('.selectpicker').selectpicker('refresh');
                        $('#new-item').html('Item ' + (data.items.indexOf(item) + 1 ) + ': ');
                    } else {
                        editMode = false;
                    }
                }

                var totalDutyCost = 0;
                $.each(data.items, function () {
                    totalDutyCost += parseFloat(this.duty_cost.substring(1));
                });
                $('#items-total-duty').html("$" + totalDutyCost.toFixed(2));
            };

            $.extend($.fn.dataTable.defaults, {
                /*searching: false,*/
                ordering: true,
                lengthChange: false
            });

            /* Get shipments' table. */
            var table = $("#shipments-table").DataTable({
                processing: true,
                serverSide: false,
                retrieve: true,
                ajax: '{!! url("admin/datatables/shipments") !!}',
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false},
                    {data: 'member_id', name: 'member_id'},
                    {data: 'member_name', name: 'member_name'},
                    {data: 'shipment_invoice', name: 'shipment_invoice', orderable: false, searchable: false},
                    {data: 'retailer_id', name: 'retailer_id'},
                    {data: 'total_value', name: 'total_value'},
                    {data: 'total_duty', name: 'total_duty'},
                    {data: 'total_vat', name: 'total_vat'},
                    {data: 'pickup_date', name: 'pickup_date'},
                    {data: 'collected_date', name: 'collected_date'},
                    {data: 'status', name: 'status'}
                ],
                fnCreatedRow: function (row, data) {
                    /*Status*/
                    /*var _status = data.status.match(/<\/i>(.*?)<\/div>/g).map(function (val) {
                     return val.replace(/<\/i>/g, '').replace(/<\/div>/g, '');
                     })[0];*/

                    var _status = data._status;

                    $(row).attr('status', _status);

                    /*Sender*/
                    $(row).attr('sender', data.retailer_id);

                    /*Order number*/
                    var _id = data.id.match(/<a href="(.*?)">(.*?)<\/a>/g).map(function (val) {
                        return val.replace(/<a href="(.*?)">/g, '').replace(/<\/a>/g, '');
                    })[0];

                    $(row).attr('id', _id);
                }
            });

            /* Table's search event. */
            $('#shipmentsInput').on('keyup', function () {
                table.search(this.value).draw();
            });

            table.column('4:visible').order('asc').draw();

            /* Table's filter event. */
            $('#filter-shipments').on('change', function () {
                @foreach($shipmentStatusMap as $key => $value)
                if ($(this).val() == '{!!$key!!}') {
                    $('#shipments-table').find('tbody').find('tr').each(function () {
                        if ($(this).attr('status') == '{!!$key!!}')
                            $(this).show();
                        else $(this).hide();
                    })
                }
                        @endforeach
                else if ($(this).val() == 'default') {
                    $('#shipments-table').find('tbody').find('tr').each(function () {
                        $(this).show();
                    })
                }
                        @foreach($retailers as $retailer)
                else if ($(this).val() == '{!!$retailer->name!!}') {
                    $('#shipments-table').find('tbody').find('tr').each(function () {
                        if ($(this).attr('sender') == '{!!$retailer->name!!}')
                            $(this).show();
                        else $(this).hide();
                    })
                }
                @endforeach

                        @foreach($shipments as $shipment)
                else if ($(this).val() == '{{$shipment->id}}') {
                    $('#shipments-table').find('tbody').find('tr').each(function () {
                        if ($(this).attr('id') == '{{$shipment->id}}')
                            $(this).show();
                        else $(this).hide();
                    })
                }
                @endforeach
            });

            //table.column('4:visible').order('asc').draw();

            /* Handle and process add new shipment wizard. */
            $("#add-shipment-wizard").steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "fade",
                autoFocus: true,
                enableAllSteps: false,
                enableCancelButton: true,
                enableFinishButton: true,
                titleTemplate: '<span class="number" number="#index#"></span> #title#',
                onStepChanging: function (event, currentIndex, newIndex) {
                    var form;

                    if (currentIndex == 0) {
                        form = $('#create-shipment-form');
                        form.validate({
                            errorPlacement: function (error, element) {
                                if (element.attr("name") == "retailer_id") {
                                    error.insertAfter(element.parent());
                                } else {
                                    error.insertAfter(element);
                                }
                            },
                            rules: {
                                retailer_website: {
                                    regex: /^((http|https):\/\/){0,1}([\w\d]+([-_][\w\d]+){0,})([\.][\w\d]+)+([\/][\w\d]+){0,}$/
                                }
                            }
                        });
                    } else if (currentIndex == 2) {
                        form = $('#purchase-details-form');
                    }


                    /* Allways allow previous action even if the current form is not valid! */
                    if (currentIndex > newIndex) {
                        return true;
                    }

                    if (currentIndex == 0) {
                        form.validate().settings.ignore = ":disabled,:hidden";

                        $.extend(true, data, form.serializeObject());
                        data['invoice'] = $('#upload-invoice-input')[0].files[0];
                        data.delivery_address = $('input[name="delivery_address"]').val();
                        data.delivery_city = $('input[name="delivery_city"]').val();
                        data.delivery_state = $('input[name="delivery_state"]').val();
                        data.delivery_zip_code = $('input[name="delivery_zip_code"]').val();
                        data.delivery_firstname = $('input[name="delivery_firstname"]').val();
                        data.delivery_lastname = $('input[name="delivery_lastname"]').val();

                        return form.valid();
                    } else if (currentIndex == 1) {
                        if (data.items.length == 0) {
                            $('#no-items-added').find('i').show();
                            $('#no-items-added').find('.col-md-12').css('color', 'red');
                            $('#no-items-added').find('.col-md-12').css('font-weight', 'bold');

                            setTimeout(function () {
                                $('#no-items-added').find('i').hide();
                                $('#no-items-added').find('.col-md-12').css('color', 'white');
                                $('#no-items-added').find('.col-md-12').css('font-weight', 'normal');
                            }, 3000);

                            return false;
                        }

                        return true;
                    } else if (currentIndex == 2) {
                        form.validate().settings.ignore = ":disabled,:hidden";
                        $.extend(true, data, form.serializeObject());

                        if (data.shipping_amount == "")
                            data.shipping_amount = 0;
                        if (data.tax_amount == "")
                            data.tax_amount = 0;

                        return form.valid();
                    }
                },
                onStepChanged: function (event, currentIndex, previousIndex) {
                    if (currentIndex == 3) {
                        /* General details */
                        if (data.retailer_id == 'add_new') {
                            $('#confirmation-sender').find('span:last-child').html(
                                    '<strong>' + data.retailer_name + '</strong>'
                            );
                        } else {
                            $.each(<?php echo $retailers; ?>, function () {
                                if (this.id == data.retailer_id)
                                    $('#confirmation-sender').find('span:last-child').html(
                                            '<strong>' + this.name + '</strong>'
                                    );
                            });
                        }

                        $('#confirmation-tracking-number').find('span:last-child').html('<strong>' + data.tracking_number + '</strong>');
                        $('#confirmation-order-number').find('span:last-child').html('<strong>' + data.order_number + '</strong>');
                        if (data.weight && data.weight != '')
                            $('#confirmtion-weight').find('span:last-child').html('<strong>' + data.weight + 'lbs </strong>');
                        if ((data.length && data.length != '') || (data.height && data.height != '') || (data.d && data.d != ''))
                            $('#confirmation-dimensions').find('span:last-child').html('<strong>' + data.length + 'cm x ' + data.height + 'cm x ' + data.d + ' cm</strong>');
                        $('#confirmation-invoice').find('a').attr('href', (window.URL ? URL : webkitURL).createObjectURL(data.invoice));
                        $('#confirmation-invoice').find('a').attr('download', data.invoice.name);

                        /* Delivery details */
                        $('#confirmation-member-details').html('Member ID: ' + data.user);
                        $('#confirmation-address').html(data.delivery_address);
                        $('#confirmation-city').html(data.delivery_city);
                        $('#confirmation-state').html(data.delivery_state);
                        $('#confirmation-zip-code').html(data.delivery_zip_code);
                        $('#confirmation-firstname').html(data.delivery_firstname);
                        $('#confirmation-lastname').html(data.delivery_lastname);

                        /* Items details */
                        $('#confirmation-items').empty();
                        $.each(data.items, function () {
                            $('<tr>' +
                                    '<td>' + this.quantity + '</td>' +
                                    '<td>' + this.description + '</td>' +
                                    '<td>$' + (this.cost * this.quantity).toFixed(2) + '</td>' +
                                    '/tr>').appendTo('#confirmation-items');
                        });

                        /* Cost details */
                        $('#confirmation-subtotal').html('<strong>$' + getShipmentSubtotal().toFixed(2) + '</strong>');
                        $('#retailer-shipping-cost').html("$" + data.shipping_amount);
                        $('#retailer-tax').html("$" + data.tax_amount);
                        $('#confirmation-total').html("$" + (getShipmentSubtotal() + parseFloat(data.shipping_amount) + parseFloat(data.tax_amount)).toFixed(2));

                        /* Duty details */
                        $('#confirmation-duty').html("$ " + getShipmentDuty().toFixed(2));
                        $('#confirmation-vat').html("$ " + ((getShipmentSubtotal() + parseFloat(data.shipping_amount) + parseFloat(data.tax_amount)).toFixed(2) * {{getSetting('VAT_TAX')}} / 100).toFixed(2));
                    }
                },
                onCanceled: function (event) {
                    $('.message-box').removeClass('open');
                },
                onFinishing: function (event, currentIndex) {
                    var formData = new FormData();

                    $.each(data, function (key, value) {
                        if ($.isArray(value)) {
                            $.each(value, function () {
                                formData.append(key + '[]', JSON.stringify(this));
                            })
                        } else {
                            formData.append(key, value);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: '{{url('/admin/shipments')}}',
                        headers: {
                            'X-CSRF-Token': '{{csrf_token()}}'
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        async: false,
                        success: function (response) {
                            /*Add new to existing table*/
                            table.ajax.reload();

                            $('.instructions').show();
                            $('.msg-on-success').show();
                            $('.msg-on-error').hide();

                            $('.notification').html('Your order has been placed, your shipment ID is <strong>' +
                                    response.shipment_id + '</strong>.');
                        },
                        error: function (response) {
                            $('.notification').html('<span style="color:red;">' +
                                    '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' +
                                    'Something went wrong! Please try again later.</span>'
                            );
                            $('.instructions').hide();
                            $('.msg-on-success').hide();
                            $('.msg-on-error').show();

                            errors = response.responseJSON.errors;
                        }
                    });

                    return true;
                },
                onFinished: function (event, currentIndex) {
                    $('.confirmation').hide();
                    $('.actions').hide();
                    $('.msg').show();

                    $('#message-box-add').find('form').each(function () {
                        this.reset();
                    });

                    $('.add-new-retailer-fields').hide();
                    $('.add-new-retailer-fields').prop('disabled', true);
                    $('#tax-amount-view').hide();
                    $('#shipping-amount-view').hide();
                }
            });

            $('#upload-invoice-btn').on('click', function (event) {
                event.stopPropagation();
                $('#upload-invoice-input').click();
            });

            $('#upload-invoice-input').on('change', function () {
                $('#uploaded-file-name').html($(this).prop('files')[0].name);
                $(this).valid();
            });

            /* Add new item or save an existing one. */
            $('#add_new_item').on('click', function (event) {
                var form = $('#add-new-item-form');
                form.validate({
                    errorPlacement: function (error, element) {
                        if (element.attr("name") == "tax" ||
                                element.attr("name") == "quantity") {
                            error.insertAfter(element.parent());
                        } else {
                            error.insertAfter(element);
                        }
                    },
                });
                if (form.valid()) {
                    var new_item = $('#add-new-item-form').serializeObject();
                    new_item.duty = $('#duty').html();
                    new_item.duty_cost = $("#duty-cost").html();

                    if (editMode) {
                        new_item.id = editId;

                        $.each(data.items, function () {
                            if (this.id == editId) {
                                data.items[data.items.indexOf(this)] = new_item;
                                $('#new-item').html('Item ' + (data.items.length + 1 )+ ': ');
                                return;
                            }
                        })
                    } else {
                        new_item.id = data.items.length;
                        data.items.push(new_item);
                        $('#new-item').html('Item ' + (data.items.length + 1 )+ ': ');
                    }

                    $('#no-items-added').hide();
                    $('#item-table').show();


                    if (editMode) {
                        $('tr#item-' + editId).html(
                                "<td class='qty-item'>" + new_item.quantity + "</td>" +
                                "<td>" + new_item.description + "</td>" +
                                "<td> $" + new_item.quantity * new_item.cost + "</td>" +
                                "<td>" + new_item.duty + "</td>" +
                                "<td>" + new_item.duty_cost + "</td>" +
                                "<td><i class='fa fa-pencil edit-item' style='cursor:pointer;' id='edit-item-" + new_item.id + "'></td>" +
                                "<td><i class='fa fa-remove delete-item' style='cursor:pointer;' id='delete-item-" + new_item.id + "'></td>"
                        );
                    } else {
                        $('#items-table-body').append(
                                "<tr id=item-" + new_item.id + ">" +
                                "<td class='qty-item'>" + new_item.quantity + "</td>" +
                                "<td>" + new_item.description + "</td>" +
                                "<td> $" + (new_item.quantity * new_item.cost).toFixed(2) + "</td>" +
                                "<td>" + new_item.duty + "</td>" +
                                "<td>" + new_item.duty_cost + "</td>" +
                                "<td><i class='fa fa-pencil edit-item' style='cursor:pointer;' id='edit-item-" + new_item.id + "'></td>" +
                                "<td><i class='fa fa-remove delete-item' style='cursor:pointer;' id='delete-item-" + new_item.id + "'></td>" +
                                "</tr>"
                        );
                    }

                    restoreAddNewItemFormFields();

                    $('.edit-item').off();
                    $('.edit-item').on('click', editItemHandler);

                    $('.delete-item').off();
                    $('.delete-item').on('click', deleteItemHandler);

                    if (editMode) {
                        editMode = false;
                        $('#add_new_item').find('span').text('+ Add item');
                        $('#cancel-item-edit').hide();
                    }
                }

                var totalDutyCost = 0;
                $.each(data.items, function () {
                    totalDutyCost += parseFloat(this.duty_cost.substring(1));
                });
                $('#items-total-duty').html("$" + totalDutyCost.toFixed(2));
            });

            /* Cancel editing an item. */
            $('#cancel-item-edit').on('click', function () {
                editMode = false;

                restoreAddNewItemFormFields();

                $('#add_new_item').find('span').text('+ Add item');
                $('#cancel-item-edit').hide();
            });

            /* Reset wizard function. */
            var resetWizard = function () {
                $('#add-shipment-wizard').steps('reset');

                $('.confirmation').show();
                $('.actions').show();
                $('.msg').hide();

                /*Restore objects, inputs and wizard*/
                data = {
                    items: [],
                    shipping_amount: 0,
                    tax_amount: 0
                };

                $('#change-user').select2('val', '');

                /* Remove existing objects in second step */
                $('#items-table-body').find('tr').remove();
                $('#no-items-added').show();

                $('#state').select2('val', '');

                /* Restore purchase details fields */
                $('input:radio[name="shipping_view"]').val('no');
                $('input:radio[name="tax_view"]').val('no');

                $('#uploaded-file-name').html('');
                $('label.error').remove();
            };

            /* Close wizard event */
            $('.close-wizard').on('click', function (event) {
                if ($(this).parent().hasClass('msg-on-success')) {
                    /*Display notification*/
                    $('#notifications').find('.col-md-12').append('<div class="noti-alert pad no-print">' +
                            '<div class="alert alert-success alert-dismissable">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' +
                            '<h4><i class="icon fa fa-check"></i> Success</h4>' +
                            '<ul>' +
                            '<li>Shipment was successfully added</li>' +
                            '</ul>' +
                            '</div>' +
                            '</div>');
                } else {
                    $('#notifications').find('.col-md-12').append('<div class="noti-alert pad no-print">' +
                            '<div class="alert alert-danger alert-dismissable">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' +
                            '<h4><i class="icon fa fa-ban"></i> Error</h4>' +
                            '<ul id="notifications-errors">' +
                            '</ul>' +
                            '</div>' +
                            '</div>');

                    $.each(errors, function () {
                        $('#notifications-errors').append('<li>' + this + '</li>');
                    });
                }

                setTimeout(function () {
                    $('#notifications').find('.col-md-12').empty();
                }, 5000);

                $('html,body').animate({
                    scrollTop: 0
                }, 0);

                /* Close and reset the wizard */
                $('.message-box').removeClass('open');

                resetWizard();
            });

            /* Reset wizard event */
            $('#reset-wizard').on('click', function (event) {
                resetWizard();
            });

            $('.wizard').find('.actions').find('a[href="#cancel"]').click(function(){
                document.body.style.overflowY = "visible";
            });
        });

    </script>
@endsection

{{--This is the first step to create a new shipment--}}
<h3 class="text-center padding-bottom">Create new shipment</h3>
<div class="row create-shipment">
    <div class="col-md-10 col-md-offset-2 col-lg-9 col-lg-offset-3">

        <form class="form-horizontal create_shipment" id="create-shipment-form" novalidate>
            <div class="form-group">
                <label class="col-md-3 control-label">Sender:</label>

                <div class="col-md-4">
                    <div class="input-group bottom0">
                        <select class="form-control select2" id="state" name="retailer_id" style="width: 100%; visibility: hidden;"
                                required>
                            <option value=""></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group add-new-retailer-fields">
                <label class="col-md-3 control-label">Name of sender:</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="sender" class="form-control" name="retailer_name" required>
                    </div>
                </div>
            </div>
            <div class="form-group add-new-retailer-fields">
                <label class="col-md-3 control-label">Website of sender:</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="col-md-12 padding0">
                            <input type="sender" class="form-control" name="retailer_website">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Tracking number:</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="sender" class="form-control" name="tracking_number">
                    </div>
                </div>
                <div class="col-md-3 optional">
                    (Optional)
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Order number:</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="sender" class="form-control" name="order_number">
                    </div>
                </div>
                <div class="col-md-3 optional">
                    (Optional)
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Weight:</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="sender" class="form-control" name="weight">
                    </div>
                </div>
                <div class="col-md-3 optional">
                    (Optional)
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Dimension:</label>
                <div class="col-md-4">
                    <label class="col-xs-2 control-label">L:</label>
                    <div class="col-xs-2 padding0">
                        <div class="input-group">
                            <input type="sender" class="form-control" name="length">
                        </div>
                    </div>

                    <label class="col-xs-2 control-label">H:</label>
                    <div class="col-xs-2 padding0">
                        <div class="input-group">
                            <input type="sender" class="form-control" name="height">
                        </div>
                    </div>
                    <label class="col-xs-2 control-label">D:</label>
                    <div class="col-xs-2 padding0">
                        <div class="input-group">
                            <input type="sender" class="form-control" name="d">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 optional">
                    (Optional)
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3 os-regular size50">Please upload your purchase invoice:</div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <a class="btn btn-warning" id="upload-invoice-btn">Upload invoice</a>
                    <input id="upload-invoice-input" name="invoice" type="file" accept="application/pdf,image/*"
                           style="visibility: hidden; position: fixed; top: -100px;" required/>
                    <span id="uploaded-file-name"></span>
                </div>
            </div>
            <div class="row">
                {{--<div class="col-xs-12">
                    <div class="row" style="margin-left: 0px;"><h4>Member details</h4></div>
                </div>--}}
                <div class="col-xs-12 col-sm-6 ">
                    <div class="row">
                        <div class="col-xs-12 form-group padding-tb5" id="user-select">
                            <div class="row">
                                <div class="col-xs-5  os-regular">
                                    <label class="col-md-12 control-label">
                                        Member id:
                                    </label>
                                </div>
                                <div class="col-xs-7 padding-tb5">
                                    <div class="input-group">
                                        <select id="change-user" class="col-xs-7 size44 select2" style="width: 100%; color:black;"
                                                name="user" required>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-xs-12 form-group">
                            <div class="row">
                                <div class="col-xs-5">
                                    <label class="col-md-12 control-label">
                                        Address:
                                    </label>
                                </div>
                                <div class="col-xs-7 padding-tb5">
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="delivery_address" required disabled>
                                    </div>
                                </div>
                                <div class="col-xs-7 col-xs-offset-5 padding-tb5">
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="delivery_city" required disabled>
                                    </div>
                                </div>
                                <div class="col-xs-7 col-xs-offset-5 padding-tb5">
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="delivery_state" required disabled>
                                    </div>
                                </div>
                                <div class="col-xs-7 col-xs-offset-5 padding-tb5">
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="delivery_zip_code" required disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 form-group">
                    <div class="row">
                        <div class="col-xs-12 padding-tb5">
                            <div class="row">
                                <div class="col-xs-5">
                                    <label class="col-md-12 control-label">
                                        First name:
                                    </label>
                                </div>
                                <div class="col-xs-7">
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="delivery_firstname" required disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-5">
                                    <label class="col-md-12 control-label">
                                        Last name:
                                    </label>
                                </div>
                                <div class="col-xs-7">
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="delivery_lastname" required disabled>
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

<script type="text/javascript">
    /* Handle sender's name and website fields visibility based on '#state' selectbox. */
    $(document).ready(function () {
        $('.add-new-retailer-fields').hide();

        /* Initialize user's list. */
        var sendersSelect2Data = <?php echo $retailers ?>;
        sendersSelect2Data.push({
            id: 'divider',
            disabled: true
        }, {
            id: 'add_new',
        });


        /* Initialize user's select2 dropdown. */
        $('#state').select2({
            data: sendersSelect2Data,
            templateResult: function (state) {
                if (!state.id) {
                    return;
                }

                var $state = null;

                if (state.id == 'add_new') {
                    $state = $(
                            '<div class="row">' +
                            '<div class="col-xs-12 text-left">+ Add sender</div>' +
                            '</div>'
                    );
                } else if(state.id == 'divider') {
                    $state = $(
                            '<div class="row">' +
                            '<div class="col-xs-12 text-left padding0"><hr class="divider-hr"/></div>' +
                            '</div>'
                    );
                } else {
                    $state = $(
                            '<div class="row">' +
                            '<div class="col-xs-12 text-left">' + state.name + '</div>' +
                            '</div>'
                    );
                }

                return $state;
            },
            templateSelection: function (state) {
                if (!state.id)
                    return 'Search by name';

                if (state.id == 'add_new')
                    return '+ Add sender';

                if(state.id == 'divider')
                    return '';

                return state.name;
            },
            matcher: function (term, text) {
                if (text.name && term.term) {
                    var _NAME = text.name.toUpperCase();
                    var _TERM = term.term.toUpperCase();

                    if (_NAME.indexOf(_TERM) != -1)
                        return text;

                    return {};
                }

                return text;
            }
        });
        $('b[role="presentation"]').hide();
        $('.select2-selection__arrow').append('<i class="fa fa-search search-select" aria-hidden="true"></i>');

        $('#state').on('change', function (event) {
            if ($(this).val() == 'add_new') {
                $('.add-new-retailer-fields').show();
                $('.add-new-retailer-fields').prop('disabled', false);

                $('.add-new-retailer-fields').find('input[name="retailer_name"]').val('');
                $('.add-new-retailer-fields').find('input[name="retailer_website"]').val('');

                $('.add-new-retailer-fields').find('input[name="retailer_name"]').removeClass('error');
                $('.add-new-retailer-fields').find('label[for="retailer_name"]').remove();
                $('.add-new-retailer-fields').find('input[name="retailer_website"]').removeClass('error');
                $('.add-new-retailer-fields').find('label[for="retailer_website"]').remove();
            }
            else {
                $('.add-new-retailer-fields').hide();
                $('.add-new-retailer-fields').prop('disabled', true);

                $('.add-new-retailer-fields').find('input[name="retailer_name"]').val($(this).val());
                $('.add-new-retailer-fields').find('input[name="retailer_website"]').val($('option:selected', this).attr('website'));
            }
        });

        /* Initialize user's list. */
        var usersSelect2Data = <?php echo $users ?>;

        /* Initialize user's select2 dropdown. */
        $('#change-user').select2({
            data: usersSelect2Data,
            templateResult: function (state) {
                if (!state.id) {
                    return;
                }

                var $state = $(
                        '<div class="row">' +
                        '<div class="col-xs-8 text-left">' + state.firstname + ' ' + state.lastname + '</div>' +
                        '<div class="col-xs-4 text-left">' + state.id + '</div>' +
                        '</div>'
                );
                return $state;
            },
            templateSelection: function (state) {
                if (!state.id)
                    return 'Search by name or id';

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

        $('#change-user').on('change', function () {
            var selectedId = $(this).val();

            $.each(<?php echo $users; ?>, function (i) {
                if (this.id == selectedId) {
                    $('input[name="delivery_address"]').val(this.bill_address.address1);
                    $('input[name="delivery_city"]').val(this.bill_address.city);
                    $('input[name="delivery_state"]').val(this.bill_address.state);
                    $('input[name="delivery_zip_code"]').val(this.bill_address.zip_code);
                    $('input[name="delivery_firstname"]').val(this.firstname);
                    $('input[name="delivery_lastname"]').val(this.lastname);
                }
            })
        })
    })
</script>
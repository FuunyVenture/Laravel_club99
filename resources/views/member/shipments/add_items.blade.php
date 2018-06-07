{{--This is the second step of the shipment where member can add items--}}
<h3 class="text-center">Add items in shipment</h3>
<div class="add-item">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <form id="add-new-item-form" class="form-horizontal create_shipment" role="form">
                <h3 id="new-item">Item 1:</h3>
                <div class="form-group">
                    <label class="col-md-3 control-label">Quantity:</label>
                    <div class="col-md-2">
                        <div class="input-group">
                            <select class="form-control selectpicker" id="quantity-select" name="quantity" required>
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>

                    <label class="col-md-2 col-md-offset-1 control-label">Item name:</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="description"
                                   placeholder="eg. Calvin Klein" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-3 col-md-1 control-label">Cost:</label>
                    <div class="col-xs-9 col-md-5">
                        <div class="input-group flex">
                            <div class="col-md-1 os-regular size44"><span>$</span></div>
                            <div class="col-md-11 flex input-error">
                                <input id="cost" type="number" class="form-control" name="cost" placeholder="0.00"
                                       min="0" max="100000"
                                       required>
                            </div>
                        </div>
                    </div>

                    <label class="col-md-3 control-label">Classification:</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <select id="change-tax" class="col-xs-7 size44 select2" style="width: 100%; color:black;"
                                    name="tax" required>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12 col-md-8" style="padding:0">
                        <label class="col-xs-3 col-md-1">Duty:</label>
                        <div class="col-xs-3 col-md-1 os-regular size44" id="duty">0%</div>
                        <label class="col-xs-3 col-md-3">Duty cost:</label>
                        <div class="col-xs-3 col-md-1 os-regular size44" id="duty-cost">$0.00</div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12 col-md-8">
                        <label class="col-xs-3 col-md-3">Item value:</label>
                        <div class="col-xs-3 col-md-1 os-regular size44" id="items-value">$0.00</div>
                    </div>
                </div>

                <div class="form-group col-md-8">
                    <a class="btn btn-warning" id="add_new_item">
                        <span>+ Add item</span>
                    </a>
                    <a class="btn btn-danger" id="cancel-item-edit" style="display: none;">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 item-bg">
            <div class="row">
                <div class="col-md-12">
                    <h4>Item summary</h4>
                </div>
            </div>
            <div class="row" id="no-items-added">
                <div class="col-md-12 os-regular size50">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true" style="display: none;"></i> No items added
                </div>
            </div>
        </div>

        <table id="item-table" class="item-bg table datatable dt-responsive" style="width:100%;">
            <thead>
            <tr>
                <th>Qty</th>
                <th>Description</th>
                <th>Item value</th>
                <th>Duty</th>
                <th>Duty Cost</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="items-table-body">
            </tbody>
            <tfooter>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="text-right">Total duty:</th>
                    <th><span id="items-total-duty"></span></th>
                </tr>
            </tfooter>
        </table>
    </div>
</div>

<script>
    /* Handle items total cost based on user's interactions through fields and buttons. */
    $(document).ready(function () {
        $('#quantity-select').on('change', function () {
            computeTotalCost();
        });

        $('#cost').on('change', function () {
            if($(this).valid()) {
                computeTotalCost();
            }
        });

        $('#change-tax').on('change', function () {
            var duty = ($(this).select2('data')[0]).duty;

            $('#duty').html(duty + '%');
            computeTotalCost();
        });

        var computeTotalCost = function () {
            var itemsValue = parseFloat($('#quantity-select').val()) * parseFloat($('#cost').val());
            var totalCost = itemsValue * parseFloat($('#duty').html().replace('%', '')) / 100;

            if (!isNaN(totalCost) && !isNaN(itemsValue)) {
                $('#items-value').html("$" + itemsValue.toFixed(2));
                $('#duty-cost').html("$" + totalCost.toFixed(2));
            } else {
                $('#items-value').html("$0.00");
                $('#duty-cost').html("$0.00");
            }
        };

        /* Initialize classification's list. */
        var data = <?php echo $taxes; ?>;

        /* Initialize user's select2 dropdown. */
        $('#change-tax').select2({
            data: data,
            templateResult: function (state) {
                if (!state.id) {
                    return;
                }

                var $state = $(
                        '<div class="row">' +
                        '<div class="col-xs-12 text-left">' + state.description + '</div>' +
                        '</div>'
                );

                return $state;
            },
            templateSelection: function (state) {
                if (!state.id)
                    return 'Search by name';

                return state.description;
            },
            matcher: function (term, text) {
                if (text.description && term.term) {
                    var _NAME = text.description.toUpperCase();
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
    })
</script>
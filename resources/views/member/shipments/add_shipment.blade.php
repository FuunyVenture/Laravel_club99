{{--This view generates a GUI for add shipment wizard in the member dashboard.
    This wizard is composed of four steps, see the following files:
    -member/shipments/create_shipment.blade.php
    -member/shipments/add_items.blade.php
    -member/shipments/purchase_details.blade.php
    -member/shipments/confirmation.blade.php
--}}

<div class="message-box animated fadeIn" id="message-box-add">
    <div class="mb-add-shipment">
        <div class="mb-middle" style="color:white">
            <i id="close-wizard" class="fa fa-times pull-right mb-control-close"></i>
            <div class="mb-content col-xs-10 col-xs-offset-1">
                <div id="add-shipment-wizard">
                    <h3>Create new shipment</h3>
                    <section>
                        @include('member.shipments.create_shipment')
                    </section>
                    <h3>Add items</h3>
                    <section>
                        @include('member.shipments.add_items')
                    </section>
                    <h3>Purchase details</h3>
                    <section>
                        @include('member.shipments.purchase_details')
                    </section>
                    <h3>Confirmation</h3>
                    <section>
                        @include('member.shipments.confirmation')
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>



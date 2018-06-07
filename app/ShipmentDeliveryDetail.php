<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipmentDeliveryDetail extends Model
{
    protected $table = 'shipment_delivery_details';

    public function shipment() {
        return $this->belongsTo(Shipment::class);
    }
}

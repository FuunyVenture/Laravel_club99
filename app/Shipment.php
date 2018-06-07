<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipment extends Model
{
    use SoftDeletes;

    public function fee() {
        return $this->belongsTo(Fee::class);
    }

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function retailer() {
        return $this->belongsTo(Retailer::class);
    }

    public function product() {
        return $this->hasOne(Product::class);
    }

    public function delivery_details() {
        return $this->hasOne(ShipmentDeliveryDetail::class);
    }
}

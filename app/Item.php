<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function shipment() {
        return $this->belongsTo(Shipment::class);
    }

    public function tax() {
        return $this->belongsTo(Tax::class);
    }

    public function retailer() {
        return $this->belongsTo(Retailer::class);
    }
}

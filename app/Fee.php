<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    public function shipments() {
        return $this->hasMany(Shipment::class);
    }

    public function product() {
        return $this->hasOne(Product::class);
    }
}

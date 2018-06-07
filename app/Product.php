<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public function fee()
    {
        return $this->belongsTo(Fee::class);
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'invoice_products');
    }
}

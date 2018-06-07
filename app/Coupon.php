<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

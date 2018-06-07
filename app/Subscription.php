<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public function user() {
        return $this->hasOne(User::class);
    }

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function store_payment() {
        return $this->belongsTo(StorePayment::class);
    }
}

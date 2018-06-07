<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function club99_details() {
        return $this->belongsTo(Club99::class);
    }

    public function gift_card() {
        return $this->belongsTo(GiftCard::class);
    }

    public function shipment() {
        return $this->hasOne(Shipment::class);
    }

    public function other_charges() {
        return $this->hasMany(OtherCharge::class);
    }

    public function subscriptions() {
        return $this->hasMany(Subscription::class);
    }

    public function coupon() {
        return $this->belongsTo(Coupon::class);
    }

    public function store_payment() {
        return $this->belongsTo(StorePayment::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'invoice_products')->withTimestamps();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

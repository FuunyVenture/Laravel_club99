<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    protected $table = 'gift_cards';

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

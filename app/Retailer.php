<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
    public function items() {
        return $this->hasMany(Item::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

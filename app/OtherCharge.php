<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherCharge extends Model
{
    protected $table = 'other_charges';

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }
}

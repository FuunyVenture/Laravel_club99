<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StorePayment extends Model
{
    protected $table = 'store_payments';

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }
}

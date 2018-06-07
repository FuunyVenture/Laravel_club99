<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club99 extends Model
{
    protected $table = 'club99_details';

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $table = 'taxes';

    public function items() {
        return $this->hasMany(Item::class);
    }
}

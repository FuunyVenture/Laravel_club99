<?php

namespace App;

use App\BaseModel;

class Menu extends BaseModel
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    function getStatusAttribute()
    {
        return $this->attributes['status'] ? 'active' : 'inactive';
    }
}

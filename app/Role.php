<?php

namespace App;

use App\BaseModel;

class Role extends BaseModel {

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function users() {
        return $this->hasMany(User::class);
    }

}

<?php

namespace App;

use App\BaseModel;
/**
 * @property array|string name
 * @property array|string status
 */
class Feature extends BaseModel
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    function getStatusAttribute()
    {
        return $this->attributes['status'] ? 'active' : 'inactive';
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class)->withPivot('spec')->withTimestamps();
    }

    public function isActive()
    {
        return $this->attributes['status'] ? true : false;
    }
}

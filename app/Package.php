<?php

namespace App;

use App\BaseModel;

/**
 * @property mixed name
 * @property array|integer cost
 * @property array|string cost_per
 * @property array|string plan
 * @property array|boolean status
 * @property array|boolean featured
 * @property array|integer pricing_order
 */
class Package extends BaseModel
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    function scopeActive($query)
    {
        return $query->where('status', 1)->orderBy('pricing_order');
    }

    function getStatusAttribute()
    {
        return $this->attributes['status'] ? 'active' : 'inactive';
    }

    function getFeaturedAttribute()
    {
        return $this->attributes['featured'] ? 'featured' : 'normal';
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class)->withPivot('spec')->withTimestamps();
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function product() {
        return $this->hasOne(Product::class);
    }
}

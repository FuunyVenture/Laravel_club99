<?php

namespace App;

use Fenos\Notifynder\Notifable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Billable, Notifable;
    
    protected $dates = ['trial_ends_at', 'subscription_ends_at', 'deleted_at'];
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the role record associated with the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getAvatarAttribute()
    {
        return 'uploads/avatars/' . $this->attributes['avatar'];
    }

    /*public function package()
    {
        return $this->belongsTo(Package::class);
    }*/

    public function shipments() {
        return $this->hasMany(Shipment::class);
    }

    public function coupon() {
        return $this->hasMany(Coupon::class);
    }

    public function subscription() {
        return $this->belongsTo(Subscription::class);
    }

    public function gift_cards() {
        return $this->hasMany(GiftCard::class);
    }

    public function home_address() {
        return $this->hasOne(Address::class)->where('type', '=', 'home');
    }

    public function bill_address() {
        return $this->hasOne(Address::class)->where('type', '=', 'bill');
    }

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }

    public function retailers() {
        return $this->hasMany(Retailer::class);
    }
}

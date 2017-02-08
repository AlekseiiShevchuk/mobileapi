<?php

namespace App\Model;

use App\Model\Address\AddressCountry;
use App\Model\Address\AddressState;

class Address extends \Eloquent
{
    protected $primaryKey = 'id_address';
    protected $table = 'clk_1d21ac51df_address';
    const CREATED_AT = 'date_add';
    const UPDATED_AT = 'date_upd';

    protected $fillable = [
        'alias',
        'company',
        'lastname',
        'firstname',
        'address1',
        'address2',
        'postcode',
        'city',
        'other',
        'phone',
        'phone_mobile',
    ];

    protected $with = [
        'country',
        'state'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->id_state = 0;
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'id_customer');
    }

    public function country()
    {
        return $this->belongsTo(AddressCountry::class, 'id_country');
    }

    public function state()
    {
        return $this->belongsTo(AddressState::class, 'id_state');
    }

    public function delivery_carts()
    {
        return $this->hasMany(Cart::class, 'id_address_delivery');
    }

    public function invoice_carts()
    {
        return $this->hasMany(Cart::class, 'id_address_invoice');
    }

    /**
     * Scope a query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $id_customer
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetUserAddresses($query, $id_customer)
    {
        return $query
            ->where('id_customer', '=', $id_customer)
            ->where('deleted', '=', 0)
            ->where('active', '=', 1)
            ->get();
    }

}

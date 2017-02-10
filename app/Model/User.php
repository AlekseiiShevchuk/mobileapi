<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    const _COOKIE_KEY_ = 'M2n8TBI70xgn7SS6v0NT35ni31B19x7EReUfuvcfZmxPHXnKK09ZZu0f';

    protected $table = 'clk_1d21ac51df_customer';
    protected $primaryKey = 'id_customer';
    const CREATED_AT = 'date_add';
    const UPDATED_AT = 'date_upd';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_gender',
        'firstname',
        'lastname',
        'email',
        'passwd',
        'secure_key',
        'birthday',
        'newsletter',
        'siret',
        'ape',
        'website',
        'company',
        'id_lang',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'passwd',
        'cart',
        'secure_key',
        'date_add',
        'data_upd'
        //'remember_token',
    ];
    protected $appends = [
        'has_cart',
    ];

    public function validateForPassportPasswordGrant($password)
    {
        return (md5(self::_COOKIE_KEY_ . $password) == $this->passwd);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'id_customer');
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'id_customer');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_customer');
    }

    public function getHasCartAttribute()
    {
        return !empty($this->cart);
    }
}

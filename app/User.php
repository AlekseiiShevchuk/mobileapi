<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    const _COOKIE_KEY_ = 'M2n8TBI70xgn7SS6v0NT35ni31B19x7EReUfuvcfZmxPHXnKK09ZZu0f';

    protected $table = 'clk_1d21ac51df_customer';
    protected $primaryKey = 'id_customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company',
        'siret',
        'ape',
        'firstname',
        'lastname',
        'email',
        'passwd',
        'birthday',
        'website',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'passwd',
        //'remember_token',
    ];

    public function validateForPassportPasswordGrant($password)
    {
        return (md5(self::_COOKIE_KEY_.$password) == $this->passwd);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Address extends Model
{
    protected $primaryKey = 'id_address';
    protected $table = 'clk_1d21ac51df_address';
    const CREATED_AT = 'date_add';
    const UPDATED_AT = 'date_upd';

    protected $fillable = [
        'id_country',
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
    
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->id_customer = Auth::user()->id_customer;
    }

    public static function getCountriesList()
    {
        return DB::table('clk_1d21ac51df_country_lang')->where('id_lang', '=', 2)->get(['name', 'id_country']);
    }

    public static function getAuthUserAddresses()
    {
        return Address::where('id_customer', '=', Auth::user()->id_customer)->where('id_country','>',0)->get();
    }
}

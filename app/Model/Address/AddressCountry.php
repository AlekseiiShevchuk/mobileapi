<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 1/30/17
 * Time: 4:34 PM
 */

namespace App\Model\Address;

use App\Model\Address;
use App\Model\Configuration;

class AddressCountry extends \Eloquent
{
    protected $table = 'clk_1d21ac51df_country';
    protected $primaryKey = 'id_country';
    public $timestamps = false;


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->with = ['descriptions' => function ($query) {
            $query->where('id_lang', '=', Configuration::getValue('PS_LANG_DEFAULT'));
        }];
    }

    public function addresses()
    {
        $this->hasMany(Address::class, 'id_country');
    }

    public function descriptions()
    {
        return $this->hasMany(AddressCountryLang::class, 'id_country');
    }
}
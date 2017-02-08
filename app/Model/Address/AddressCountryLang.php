<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 1/30/17
 * Time: 4:36 PM
 */

namespace App\Model\Address;

class AddressCountryLang extends \Eloquent
{
    protected $table = 'clk_1d21ac51df_country_lang';
    protected $primaryKey = 'id_country';
    public $timestamps = false;

}
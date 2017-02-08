<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 1/30/17
 * Time: 10:30 AM
 */

namespace App\Model\Currency;


use App\Model\Currency;

class CurrencyShop extends \Eloquent
{
    protected $table = 'clk_1d21ac51df_currency_shop';
    protected $primaryKey = 'id_currency';
    public $timestamps = false;

}
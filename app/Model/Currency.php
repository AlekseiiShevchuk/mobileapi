<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 1/30/17
 * Time: 10:33 AM
 */

namespace App\Model;


class Currency extends \Eloquent
{
    protected $table = 'clk_1d21ac51df_currency';
    protected $primaryKey = 'id_currency';

    protected $hidden = [
        'id_currency',
        'deleted',
        'active',
        'id_shop'
    ];

}
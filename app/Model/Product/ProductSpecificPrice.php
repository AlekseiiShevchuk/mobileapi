<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 1/30/17
 * Time: 12:30 PM
 */

namespace App\Model\Product;

class ProductSpecificPrice extends \Eloquent
{
    protected $primaryKey = 'id_specific_price';
    protected $table = 'clk_1d21ac51df_specific_price';
    public $timestamps = false;


    protected $hidden = [
        'id_specific_price_rule',
        'id_cart',
        'id_product',
        'id_shop',
        'id_shop_group',
    ];
}
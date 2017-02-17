<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 1/30/17
 * Time: 12:44 PM
 */

namespace App\Model\Product;

class ProductAttributeCombination extends \Eloquent
{
    public $timestamps = false;

    protected $primaryKey = 'id_product_attribute';
    protected $table = 'clk_1d21ac51df_product_attribute_combination';

    protected $hidden =[
        'id_product_attribute'
    ];

}
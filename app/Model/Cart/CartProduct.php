<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 2/8/17
 * Time: 3:31 PM
 */

namespace App\Model\Cart;

use App\Model\Cart;
use App\Model\Configuration;
use App\Model\Product;

class CartProduct extends \Eloquent
{
    protected $table = 'clk_1d21ac51df_cart_product';
    protected $primaryKey = 'id_cart';
    protected $with = [
        'product'
    ];

    protected $fillable = [
        'id_cart',
        'id_product',
        'id_product_attribute',
        'quantity'
    ];

    const CREATED_AT = 'date_add';
    const UPDATED_AT = 'date_add';


    public function __construct(array $attributes = [])
    {
        $this->id_shop = Configuration::getValue('PS_SHOP_DEFAULT');
        $this->id_address_delivery = 0;
        parent::__construct($attributes);
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id_product', 'id_product');
    }

}
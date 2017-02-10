<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 2/8/17
 * Time: 3:17 PM
 */

namespace App\Model;


use App\Model\Cart\CartProduct;

class Cart extends \Eloquent
{
    protected $table = 'clk_1d21ac51df_cart';
    protected $primaryKey = 'id_cart';

    const CREATED_AT = 'date_add';
    const UPDATED_AT = 'date_upd';

    protected $fillable = [
        'id_address_delivery',
        'id_address_invoice',
        'id_customer',
        'delivery_option',
    ];

    protected $with = [
        'products',
        'address_delivery',
        'address_invoice'
    ];

    public function __construct(array $attributes = [])
    {
        $this->id_lang = Configuration::getValue('PS_LANG_DEFAULT');
        $this->id_shop = Configuration::getValue('PS_SHOP_DEFAULT');
        $this->id_shop_group = 1;
        $this->id_guest = 0;
        $this->id_currency = Configuration::getValue('PS_CURRENCY_DEFAULT');
        $this->id_address_delivery = 0;
        $this->id_address_invoice = 0;
        $this->id_customer = 0;
        $this->id_carrier = 0;
        parent::__construct($attributes);
        $this->delivery_option = serialize([$this->id_address_delivery => $this->id_carrier . ',']);
    }

    public function carrier()
    {
        return $this->belongsTo(Carrier::class, 'id_carrier');
    }

    public function customer()
    {
        return $this->belongsTo(Cart::class, 'id_customer');
    }

    public function address_delivery()
    {
        return $this->belongsTo(Address::class, 'id_address_delivery');
    }

    public function address_invoice()
    {
        return $this->belongsTo(Address::class, 'id_address_invoice');
    }

    public function products()
    {
        return $this->hasMany(CartProduct::class, 'id_cart');
    }
}
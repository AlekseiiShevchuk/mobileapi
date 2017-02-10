<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 2/9/17
 * Time: 11:41 AM
 */

namespace App\Model;

use App\Model\Order\OrderDetail;

class Order extends \Eloquent
{
    protected $table = 'clk_1d21ac51df_orders';
    protected $primaryKey = 'id_order';
    const CREATED_AT = 'date_add';
    const UPDATED_AT = 'date_upd';

    public function __construct(array $attributes = [])
    {
        $this->id_lang = Configuration::getValue('PS_LANG_DEFAULT');
        $this->id_shop = Configuration::getValue('PS_SHOP_DEFAULT');
        $this->id_shop_group = 1;
        $this->id_currency = Configuration::getValue('PS_CURRENCY_DEFAULT');
        $this->id_address_delivery = 0;
        $this->id_address_invoice = 0;
        $this->id_customer = 0;
        parent::__construct($attributes);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_customer');
    }

    public function details(){
        return $this->hasMany(OrderDetail::class,'id_order');
    }


}
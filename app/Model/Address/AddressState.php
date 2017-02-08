<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 1/30/17
 * Time: 4:45 PM
 */

namespace App\Model\Address;


use App\Model\Address;

class AddressState extends \Eloquent
{
    protected $table = 'clk_1d21ac51df_state';
    protected $primaryKey = 'id_state';
    public $timestamps = false;

    public function addresses()
    {
        $this->hasMany(Address::class, 'id_state');
    }


}
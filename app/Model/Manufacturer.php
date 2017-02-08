<?php

namespace App\Model;

class Manufacturer extends \Eloquent
{
    protected $primaryKey = 'id_manufacturer';
    protected $table = 'clk_1d21ac51df_manufacturer';
    const CREATED_AT = 'date_add';
    const UPDATED_AT = 'date_upd';
    protected $hidden = [
        'active'
    ];
}

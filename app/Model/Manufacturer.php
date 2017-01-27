<?php

namespace App\Model;

class Manufacturer extends \Eloquent
{
    protected $primaryKey = 'id_manufacturer';
    protected $table = 'clk_1d21ac51df_manufacturer';
    protected $hidden = [
        'date_add',
        'date_upd',
    ];
}

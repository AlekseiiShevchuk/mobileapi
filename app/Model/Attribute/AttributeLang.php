<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 2/16/17
 * Time: 3:06 PM
 */

namespace App\Model\Attribute;

class AttributeLang extends \Eloquent
{
    public $timestamps = false;

    protected $table = 'clk_1d21ac51df_attribute_lang';
    protected $primaryKey  ='id_attribute';

    protected $hidden =[
        'id_attribute',
        'id_lang'
    ];

}
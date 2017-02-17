<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 2/16/17
 * Time: 3:06 PM
 */

namespace App\Model;

use App\Model\Attribute\AttributeLang;
use App\Model\Product\ProductAttribute;
use App\Model\Product\ProductAttributeCombination;

class Attribute extends \Eloquent
{
    public $timestamps = false;

    protected $table = 'clk_1d21ac51df_attribute';
    protected $primaryKey  ='id_attribute';

    protected $hidden =[
        'id_attribute_group'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->with = ['descriptions' => function ($query) {
            $query->where('id_lang', '=', Configuration::getValue('PS_LANG_DEFAULT'));
        },
//        'productAttributes'
        ];
    }

    public function descriptions()
    {
        return $this->hasMany(AttributeLang::class , $this->primaryKey);
    }

    public function productAttributes(){
        return $this->hasManyThrough(
            ProductAttribute::class,ProductAttributeCombination::class,
            $this->primaryKey,\App::make(ProductAttribute::class)->getKeyName(),$this->primaryKey);
    }

}
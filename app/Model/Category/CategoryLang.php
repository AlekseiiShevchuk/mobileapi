<?php

namespace App\Model\Category;

class CategoryLang extends \Eloquent
{
    protected $table = 'clk_1d21ac51df_category_lang';
    protected $primaryKey = 'id_category';
    protected $appends = [
        'image'
    ];

    public function getImageAttribute()
    {
        return $_SERVER['SERVER_NAME'].'/c/' . $this->id_category . '-tm_category_default/' .
            $this->link_rewrite . '.jpg';
    }

}

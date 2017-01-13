<?php

namespace App;

class ProductCategory extends \Eloquent
{
    protected $table = 'clk_1d21ac51df_category';
    protected $primaryKey = 'id_category';

    public static function getAllCategories()
    {
        return \DB::table('clk_1d21ac51df_category_lang')
            ->where('id_lang', 2)->paginate();
    }

    public static function getCategoryById($id)
    {
        return \DB::table('clk_1d21ac51df_category_lang')
            ->where('id_lang', 2)
            ->where('id_category', $id)
            ->get()->first();
    }
}

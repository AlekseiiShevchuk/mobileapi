<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'clk_1d21ac51df_product';
    protected $primaryKey = 'id_product';

    /**
     * @param $categoryId
     * @return mixed
     */
    public static function getProductsByCategory($categoryId)
    {
        return DB::table('clk_1d21ac51df_product')
            ->join('clk_1d21ac51df_category_product', 'clk_1d21ac51df_product.id_product', '=',
                'clk_1d21ac51df_category_product.id_product')
            ->select('clk_1d21ac51df_product.*', 'clk_1d21ac51df_category_product.id_category')
            ->where('id_category', $categoryId);
    }

    /**
     * @param $numberOfProducts
     * @return mixed
     */
    public static function getNewProducts($numberOfProducts)
    {
        return DB::table('clk_1d21ac51df_product')
            ->orderBy('date_add', 'desc')
            ->take($numberOfProducts)
            ->get();
    }

    /**
     * @param $numberOfProducts
     * @return mixed
     */
    public static function getTopSalesProducts($numberOfProducts)
    {
        return DB::table('clk_1d21ac51df_product')
            ->join('clk_1d21ac51df_product_sale', 'clk_1d21ac51df_product.id_product', '=',
                'clk_1d21ac51df_product_sale.id_product')
            ->select('clk_1d21ac51df_product.*', 'clk_1d21ac51df_product_sale.*')
            ->orderBy('clk_1d21ac51df_product_sale.quantity', 'desc')
            ->take($numberOfProducts)
            ->get()
            ;
    }
}

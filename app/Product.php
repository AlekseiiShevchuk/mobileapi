<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'clk_1d21ac51df_product';
    protected $primaryKey = 'id_product';
    const DEFAULT_LANGUAGES = 2;

    public function images()
    {
        return $this->hasMany('App\ProductImage', 'id_product');
    }

    public function descriptions()
    {
        return $this->hasMany('App\ProductLangDescription', 'id_product');
    }

    public function manufacturer()
    {
        return $this->hasOne('App\ProductManufacturer', 'id_manufacturer');
    }

    /**
     * Scope a query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $search
     * @param int $pagination
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function scopeSearch($query, $search = [], $pagination)
    {
        return $query->whereHas('descriptions', function ($query) use ($search) {
            $query->where('id_lang', '=', self::DEFAULT_LANGUAGES);
            foreach ($search as $key => $value) {
                $query->where($key, 'LIKE', '%' . $value . '%');
            }
        })
            ->with(['images', 'descriptions', 'manufacturer'])
            ->paginate($pagination);
    }

    /**
     * @param $categoryId
     * @return mixed
     */
    public static function getProductsByCategory($categoryId)
    {
        $productIdsArray = DB::table('clk_1d21ac51df_product')->join('clk_1d21ac51df_category_product',
            'clk_1d21ac51df_product.id_product', '=',
            'clk_1d21ac51df_category_product.id_product')->select('clk_1d21ac51df_product.*',
            'clk_1d21ac51df_category_product.id_category')->where('id_category',
            $categoryId)->pluck('clk_1d21ac51df_product.id_product')->toArray();
        return Product::whereIn('id_product', $productIdsArray)->with('images', 'descriptions', 'manufacturer');
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
            ->get();
    }
}

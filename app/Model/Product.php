<?php

namespace App\Model;

use App\Model\Product\ProductCategory;
use App\Model\Product\ProductLangDescription;
use App\Model\Product\ProductSale;

class Product extends \Eloquent
{
    protected $table = 'clk_1d21ac51df_product';
    protected $primaryKey = 'id_product';

    protected $hidden = [
        'date_add',
        'date_upd',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->with = ['images',
            'descriptions' => function ($query) {
                $query->where('id_lang', '=', Configuration::getValue('PS_LANG_DEFAULT'));
            },
            'manufacturer',
        'sale'];
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'id_product');
    }

    public function categories()
    {
        return $this->hasMany(ProductCategory::class, 'id_product');
    }

    public function descriptions()
    {
        return $this->hasMany(ProductLangDescription::class, 'id_product');
    }

    public function manufacturer()
    {
        return $this->hasOne(Manufacturer::class, 'id_manufacturer');
    }

    public function sale()
    {
        return $this->hasOne(ProductSale::class, 'id_product');
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
            $query->where('id_lang', '=', Configuration::getValue('PS_LANG_DEFAULT'));
            foreach ($search as $key => $value) {
                $query->where($key, 'LIKE', '%' . $value . '%');
            }
        })
            ->paginate($pagination);
    }

    /**
     * Scope a query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $categoryId
     * @param int $pagination
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeByCategory($query, $categoryId, $pagination)
    {
        return $query->whereHas('categories', function ($query) use ($categoryId) {
            $query->where('id_category', '=', $categoryId);
        })
            ->paginate($pagination);
    }

    /**
     * Scope a query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $pagination
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeNew($query, $pagination)
    {
        return $query
            ->orderBy('date_add', 'desc')
            ->paginate($pagination);
    }

    /**
     * Scope a query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $pagination
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTopSales($query, $pagination)
    {
        $relation = $this->sale();
        $related = $relation->getRelated();
        $table = $related->getTable();
        $foreignKey = $relation->getForeignKey();

        $query->join($table, $foreignKey, '=', $this->getQualifiedKeyName())
            ->orderBy($table . '.' . 'quantity', 'DESC');

        return $query
            ->paginate($pagination);
    }
}

<?php

namespace App;

class Product extends \Eloquent
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

    public function sale()
    {
        return $this->hasOne('App\ProductSale', 'id_product');
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
     * Scope a query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $categoryId
     * @param int $pagination
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeByCategory($query, $categoryId, $pagination)
    {
        return $query->where('id_category_default', '=', $categoryId)
            ->with('images', 'descriptions', 'manufacturer')
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
            ->with('images', 'descriptions', 'manufacturer')
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
            ->with('images', 'descriptions', 'manufacturer')
            ->paginate($pagination);
    }
}

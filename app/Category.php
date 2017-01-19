<?php

namespace App;

class Category extends \Eloquent
{
    protected $table = 'clk_1d21ac51df_category';
    protected $primaryKey = 'id_category';
    protected $appends = [
        'has_children',
        'count_products'
    ];
    protected $hidden = [
        'products',
        'active',
        'id_parent',
        'id_shop_default',
        'date_add',
        'date_upd',
        'is_root_category'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->with = ['descriptions' => function ($query) {
            $query->where('id_lang', '=', Configuration::getValue('PS_LANG_DEFAULT'));
        }];
    }

    public function descriptions()
    {
        return $this->hasMany(CategoryLang::class, 'id_category');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'id_parent');
    }

    public function products()
    {
        return $this->hasMany(ProductCategory::class, 'id_category');
    }

    public function getHasChildrenAttribute()
    {
        return $this->children->isNotEmpty();
    }

    public function getCountProductsAttribute()
    {
        return $this->products->count();
    }

    /**
     * Scope a query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $dept
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function getSub($query, $dept)
    {
        return $dept > 0 ?
            $query->with(['children' => function ($query) use ($dept) {
                self::getSub($query, $dept - 1);
                $query->where('active', '=', 1);
            }]) : $query;
    }

    /**
     * Scope a query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $dept
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeHome($query, $dept = 0)
    {
        return self::getSub($query, $dept)
            ->where('id_parent', '=', Configuration::getValue('PS_HOME_CATEGORY'))
            ->get();
    }


}

<?php

namespace App;

class Category extends \Eloquent
{
    protected $table = 'clk_1d21ac51df_category';
    protected $primaryKey = 'id_category';
    protected $appends = ['has_children'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->with = [ 'descriptions' => function ($query) {
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

    public function getHasChildrenAttribute(){
        $children = $this->children->all();
        return !empty($children);
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
            }]) :$query;
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

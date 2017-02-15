<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 2/15/17
 * Time: 2:50 PM
 */

namespace App\Model\Blog;

use App\Model\Blog\Category\CategoryLang;
use App\Model\Configuration;

class Category extends \Eloquent
{
    protected $table = 'clk_1d21ac51df_smart_blog_category';
    protected $primaryKey = 'id_smart_blog_category';
    protected $appends = [
        'has_children',
        'count_posts'
    ];
    protected $hidden = [
        'posts',
        'active',
        'id_parent',
        'created',
        'modified'
    ];

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->with = ['descriptions' => function ($query) {
            $query->where('id_lang', '=', Configuration::getValue('PS_LANG_DEFAULT'));
        }];
    }

    public function descriptions()
    {
        return $this->hasMany(CategoryLang::class, 'id_smart_blog_category');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'id_parent');
    }
    public function posts()
    {
        return $this->hasMany(Post::class, 'id_category');
    }

    public function getHasChildrenAttribute()
    {
        return $this->children
            ->where('active','=',1)
            ->isNotEmpty();
    }

    public function getCountPostsAttribute()
    {
        return $this->posts->count();
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
            ->where('id_parent', '=', 0)
            ->get();
    }



}
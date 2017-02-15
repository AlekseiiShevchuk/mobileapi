<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 2/15/17
 * Time: 2:39 PM
 */

namespace App\Model\Blog;

use App\Model\Blog\Post\PostLang;
use App\Model\Configuration;

class Post extends \Eloquent
{
    protected $table = 'clk_1d21ac51df_smart_blog_post';
    protected $primaryKey = 'id_smart_blog_post';

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
        return $this->hasMany(PostLang::class, 'id_smart_blog_post');
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
        return $query->where('id_category', '=', $categoryId)
            ->where('active', '=', 1)
            ->where('available', '=', 1)
            ->orderBy('created', 'desc')
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
            ->where('active', '=', 1)
            ->where('available', '=', 1)
            ->orderBy('created', 'desc')
            ->paginate($pagination);
    }

}
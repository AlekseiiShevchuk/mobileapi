<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 2/16/17
 * Time: 3:19 PM
 */

namespace App\Model\Attribute;

use App\Model\Attribute;
use App\Model\Configuration;
use Illuminate\Database\Eloquent\Builder;

class AttributeGroup extends \Eloquent
{
    public $timestamps = false;

    protected $table = 'clk_1d21ac51df_attribute_group';
    protected $primaryKey = 'id_attribute_group';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->with = ['descriptions' => function ($query) {
            $query->where('id_lang', '=', Configuration::getValue('PS_LANG_DEFAULT'));
        },
            'attributes'];
    }

    public function descriptions()
    {
        return $this->hasMany(AttributeGroupLang::class, $this->primaryKey);
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class, $this->primaryKey);
    }

    /**
     * Scope a query.
     *
     * @param Builder $query
     * @param int $productId
     * @return Builder
     */
    public function scopeAttributeByProduct(Builder $query, $productId)
    {
        return $query->whereHas('attributes',function ($query) use ($productId) {
            $query->whereHas('productAttributes', function ($query) use ($productId) {
                $query->where('id_product', '=', $productId);
            });
        })
            ->with(['attributes' => function ($query) use ($productId) {
                $query->whereHas('productAttributes', function ($query) use ($productId) {
                    $query->where('id_product', '=', $productId);
                });
            }]);
    }


}
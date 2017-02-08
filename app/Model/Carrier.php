<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 2/7/17
 * Time: 7:40 PM
 */
namespace App\Model;

use App\Model\Carrier\CarrierLang;
use App\Model\Carrier\CarrierZone;

class Carrier extends \Eloquent
{
    protected $table = 'clk_1d21ac51df_carrier';
    public $timestamps = false;
    protected $primaryKey = 'id_carrier';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->with = [
            'descriptions' => function ($query) {
                $query->where('id_lang', '=', Configuration::getValue('PS_LANG_DEFAULT'));
            },
        ];
    }

    public function descriptions()
    {
        return $this->hasMany(CarrierLang::class, 'id_carrier');
    }

    public function zones()
    {
        return $this->hasMany(CarrierZone::class, 'id_carrier');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'id_carrier');
    }

    /**
     * Scope a query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $zoneId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetByZone($query, $zoneId)
    {
        return $query->whereHas('zones', function ($query) use ($zoneId) {
            $query->where('id_zone', '=', $zoneId);
        })
            ->where('active', '=', 1)
            ->where('deleted', '=', 0);
    }

}
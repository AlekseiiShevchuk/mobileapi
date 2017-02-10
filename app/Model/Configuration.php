<?php

namespace App\Model;

class Configuration extends \Eloquent
{
    protected $table = 'clk_1d21ac51df_configuration';

    protected $primaryKey = 'id_configuration';

    /**
     * Scope a query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $key
     * @return string
     */

    public static function scopeGetValue($query, $key)
    {
        return $query->where('name', '=', $key)->first()->value;
    }
}

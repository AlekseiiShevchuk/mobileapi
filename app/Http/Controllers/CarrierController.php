<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 2/7/17
 * Time: 7:57 PM
 */

namespace App\Http\Controllers;


use App\Model\Carrier;

/**
 * Class CarrierController
 * @package App\Http\Controllers
 * @resource Carrier
 */
class CarrierController extends Controller
{
    /**
     * Get Carrier by Zone location
     * @param $zoneId
     * @return mixed
     */
    public function getByZone($zoneId)
    {
        return Carrier::getByZone((int)$zoneId)->get();
    }

}
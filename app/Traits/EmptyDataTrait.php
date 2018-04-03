<?php
/**
 * Created by PhpStorm.
 * User: May
 * Date: 4/1/2018
 * Time: 10:14 AM
 */

namespace App\Traits;

trait EmptyDataTrait
{
    final protected function returnEmptyData()
    {
        return ['data' => []];
    }
}
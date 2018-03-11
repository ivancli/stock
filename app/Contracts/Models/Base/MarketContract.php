<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 10/03/2018
 * Time: 12:49 AM
 */

namespace Stock\Contracts\Models\Base;


use Stock\Contracts\Models\BaseContract;
use Stock\Models\Base\Market;

abstract class MarketContract extends BaseContract
{
    public function __construct(Market $model)
    {
        parent::__construct($model);
    }
}
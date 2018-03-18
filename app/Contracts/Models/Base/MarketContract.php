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

/**
 * Class MarketContract
 * @package Stock\Contracts\Models\Base
 */
abstract class MarketContract extends BaseContract
{
    /**
     * MarketContract constructor.
     * @param Market $market
     */
    public function __construct(Market $market)
    {
        parent::__construct($market);
    }
}
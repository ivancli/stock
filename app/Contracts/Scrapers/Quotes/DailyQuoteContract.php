<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 18/03/2018
 * Time: 2:28 PM
 */

namespace Stock\Contracts\Scrapers\Quotes;


use Stock\Contracts\Scrapers\ScraperContract;

abstract class DailyQuoteContract implements ScraperContract
{

    /**
     * @return DailyQuoteContract
     */
    abstract public function fetch();

    /**
     * @return DailyQuoteContract
     */
    abstract public function extract();
}
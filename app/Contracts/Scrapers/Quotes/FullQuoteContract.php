<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 18/03/2018
 * Time: 2:29 PM
 */

namespace Stock\Contracts\Scrapers\Quotes;


use Stock\Contracts\Scrapers\ScraperContract;

abstract class FullQuoteContract implements ScraperContract
{

    /**
     * @return FullQuoteContract
     */
    abstract public function fetch();

    /**
     * @return FullQuoteContract
     */
    abstract public function extract();
}
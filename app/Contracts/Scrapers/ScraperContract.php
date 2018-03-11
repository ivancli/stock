<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 11/03/2018
 * Time: 4:17 PM
 */

namespace Stock\Contracts\Scrapers;


interface ScraperContract
{
    /**
     * Fetch content from given resources
     * @return void
     */
    public function fetch();

    /**
     * Extract items from given content
     *
     * @return void
     */
    public function extract();
}
<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/03/2018
 * Time: 9:39 AM
 */

namespace Stock\Contracts\Helpers;


interface Excel
{
    /**
     * Load Excel Spreadsheet from particular source
     *
     * @param string $path
     * @param string $method
     * @return $this
     */
    public function loadExcel(string $path, string $method = 'file');

    /**
     * Convert Excel content to JSON string
     *
     * @return string
     */
    public function toJson();

    /**
     * Convert Excel content to array
     *
     * @param bool $associative
     * @return array
     */
    public function toArray(bool $associative = true);

    /**
     * Convert Excel content to array of objects
     *
     * @return array
     */
    public function toObjects();
}
<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/03/2018
 * Time: 10:18 AM
 */

namespace Stock\Facades;


use Illuminate\Support\Facades\Facade;

class Spreadsheet extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Spreadsheet';
    }
}
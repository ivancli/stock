<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/03/2018
 * Time: 10:20 AM
 */

namespace Stock\Providers;


use Illuminate\Support\ServiceProvider;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExcelServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind('Spreadsheet', function () {
            return new Spreadsheet();
        });
    }
}
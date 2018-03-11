<?php

namespace Tests\Unit\Facades;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpreadsheetTest extends TestCase
{
    /**
     * Test if facade is bound successfully
     *
     * @return void
     */
    public function testFacadeBinding()
    {
        $this->assertEquals(get_class($this->app->make(\Spreadsheet::class)), Spreadsheet::class);
    }
}

<?php

namespace Tests\Unit\Repositories\Helpers\Excel;

use Stock\Repositories\Helpers\Excel\ExcelRepository;
use Stock\Traits\Tests\RefreshFileStorage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExcelRepositoryTest extends TestCase
{
    use RefreshFileStorage, WithFaker;

    /**
     * Test loading excel file
     *
     * @return void
     */
    public function testLoadExcelByFile()
    {
        $fileName = 'tmp.csv';
        $originalArray = $this->makeDummyExcelFile($fileName);
        $excelRepository = $this->app->make(ExcelRepository::class);
        $excelRepository->loadExcel(storage_path('app/' . $this->tmpDirectoryPath . '/' . $fileName));
        $this->assertTrue(true);
    }

    /**
     * TODO need to implement this
     */
    public function testLoadExcelByUrl()
    {
        $this->assertTrue(true);
    }

    public function testToJSON()
    {
        $fileName = 'tmp.csv';
        $originalArray = $this->makeDummyExcelFile($fileName);
        $excelRepository = $this->app->make(ExcelRepository::class);
        $jsonString = $excelRepository
            ->loadExcel(storage_path('app/' . $this->tmpDirectoryPath . '/' . $fileName))
            ->toJson();
        $this->assertTrue(is_string($jsonString));
        $this->assertNotNull(json_decode($jsonString));
        $this->assertEquals(JSON_ERROR_NONE, json_last_error());
        $decodedObjects = json_decode($jsonString);
        if (!is_null($decodedObjects) && json_last_error() === JSON_ERROR_NONE) {
            $this->assertCount(count($originalArray) - 1, $decodedObjects);
        }
    }

    public function testToArray()
    {
        $fileName = 'tmp.csv';
        $originalArray = $this->makeDummyExcelFile($fileName);
        $excelRepository = $this->app->make(ExcelRepository::class);
        $array = $excelRepository
            ->loadExcel(storage_path('app/' . $this->tmpDirectoryPath . '/' . $fileName))
            ->toArray(false);
        $this->assertCount(count($originalArray), $array);
        $this->assertEquals($originalArray, $array);
    }

    public function testToAssociativeArray()
    {
        $fileName = 'tmp.csv';
        $originalArray = $this->makeDummyExcelFile($fileName);
        $excelRepository = $this->app->make(ExcelRepository::class);
        $array = $excelRepository
            ->loadExcel(storage_path('app/' . $this->tmpDirectoryPath . '/' . $fileName))
            ->toArray();
        $headers = array_keys(array_first($array));
        $this->assertEquals(array_values(array_sort($headers)), array_values(array_sort(array_unique(array_first($originalArray)))));
        $this->assertCount(count($originalArray) - 1, $array);
    }

    public function testToObjects()
    {
        $fileName = 'tmp.csv';
        $originalArray = $this->makeDummyExcelFile($fileName);
        $excelRepository = $this->app->make(ExcelRepository::class);
        $objects = $excelRepository
            ->loadExcel(storage_path('app/' . $this->tmpDirectoryPath . '/' . $fileName))
            ->toObjects();
        $this->assertTrue(is_array($objects));
        $this->assertTrue(is_object(array_first($objects)));
        $this->assertCount(count($originalArray) - 1, $objects);
    }

    protected function makeDummyExcelFile($fileName = 'tmp.csv')
    {
        $array = [];
        $rowsCount = rand(5, 100);
        $columnsCount = rand(10, 50);
        $tempRowsCount = $rowsCount;
        while ($tempRowsCount-- > 0) {
            $array[] = $this->faker->words($columnsCount);
        }
        $csv = array_to_csv($array);
        \Storage::put($this->tmpDirectoryPath . '/' . $fileName, $csv);
        return $array;
    }
}

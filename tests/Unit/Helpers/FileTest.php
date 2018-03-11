<?php

namespace Tests\Unit\Helpers;

use Stock\Traits\Tests\RefreshFileStorage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileTest extends TestCase
{
    use RefreshFileStorage, WithFaker;

    public function testListFiles()
    {
        $this->generateDummyFiles();

        $this->assertEquals(
            count(list_files(storage_path('app/' . $this->tmpDirectoryPath))),
            count(\Storage::files($this->tmpDirectoryPath))
        );
    }

    public function testListFilesRecursive()
    {
        $this->generateDummyFiles(rand(0, 10), true);

        $this->assertEquals(
            count(list_files(storage_path('app/' . $this->tmpDirectoryPath), true)),
            count(\Storage::allFiles($this->tmpDirectoryPath))
        );
    }

    public function testListDirectories()
    {
        $this->generateDummyDirectories();

        $this->assertEquals(
            count(list_directories(storage_path('app/' . $this->tmpDirectoryPath))),
            count(\Storage::directories($this->tmpDirectoryPath))
        );
    }

    public function testArrayToCSV()
    {
        $array = [];
        $rowsCount = rand(5, 100);
        $columnsCount = rand(10, 50);
        $tempRowsCount = $rowsCount;
        while ($tempRowsCount-- > 0) {
            $array[] = $this->faker->words($columnsCount);
        }
        $csv = array_to_csv($array);
        $rows = explode("\n", $csv);
        $columns = explode(",", array_first($rows));
        $this->assertCount($rowsCount, $rows);
        $this->assertCount($columnsCount, $columns);
    }

    /**
     * generate dummy files (and directories if recursive is true)
     *
     * @param int|null $count
     * @param bool $recursive
     */
    protected function generateDummyFiles(int $count = null, $recursive = false)
    {
        if (is_null($count) || !is_int($count)) {
            $count = rand(0, 10);
        }
        while ($count > 0) {
            $this->faker->file('/tmp', storage_path('app/' . $this->tmpDirectoryPath));
            $count--;
        }

        if ($recursive === true) {
            $this->generateDummyDirectories();
            $directories = \Storage::directories($this->tmpDirectoryPath);
            foreach ($directories as $directory) {
                $this->faker->file('/tmp', storage_path('app/' . $directory));
            }
        }
    }

    /**
     * generating dummy directories
     *
     * @param int|null $count
     * @param bool $recursive
     */
    protected function generateDummyDirectories(int $count = null, $recursive = false)
    {
        if (is_null($count) || !is_int($count)) {
            $count = rand(0, 10);
        }
        while ($count-- > 0) {
            \Storage::makeDirectory($this->tmpDirectoryPath . '/' . $this->faker->word, 0755, true, true);
        }
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 3/03/2018
 * Time: 1:07 PM
 */

namespace Stock\Traits\Tests;


trait RefreshFileStorage
{
    protected $tmpDirectoryPath = null;

    public function refreshFileStorage()
    {
        $this->beginFileTransaction();
    }

    protected function setUpTmpDirectoryPath()
    {
        $this->tmpDirectoryPath = config('file.tmp', 'tmp');
    }

    protected function prepareTmpDirectory()
    {

//        if (!file_exists($this->tmpDirectoryPath)) {
        if (!\Storage::exists($this->tmpDirectoryPath)) {
            \Storage::makeDirectory($this->tmpDirectoryPath, 0755, true, true);
        }
    }

    protected function destroyTmpDirectory()
    {
//        if (file_exists(storage_path('app/' . $this->tmpDirectoryPath))) {
        if (\Storage::exists($this->tmpDirectoryPath)) {
            \Storage::deleteDirectory($this->tmpDirectoryPath);
        }
    }

    protected function beginFileTransaction()
    {
        $this->setUpTmpDirectoryPath();
        $this->prepareTmpDirectory();
        $this->beforeApplicationDestroyed(function () {
            $this->destroyTmpDirectory();
        });
    }
}
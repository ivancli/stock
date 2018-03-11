<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/03/2018
 * Time: 9:58 AM
 */

namespace Stock\Repositories\Helpers\Excel;


use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Stock\Contracts\Helpers\Excel;

class ExcelRepository implements Excel
{
    /**
     * @var Spreadsheet
     */
    protected $spreadsheet;

    /**
     * Load Excel Spreadsheet from particular source
     *
     * @param string $path
     * @param string $method
     * @return $this
     */
    public function loadExcel(string $path, string $method = 'file')
    {
        switch ($method) {
            case 'file':
                $this->spreadsheet = IOFactory::load($path);
                break;
            case 'url':
                break;
            default:
                throw new \RuntimeException('Load Excel method is not supported.');
        }

        return $this;
    }

    /**
     * Convert Excel content to JSON string
     *
     * @return string
     */
    public function toJson()
    {
        $arrayResult = $this->toArray();
        return json_encode($arrayResult);
    }

    /**
     * Convert Excel content to array
     *
     * @param bool $associative
     * @return array
     */
    public function toArray(bool $associative = true)
    {
        $activeSheet = $this->spreadsheet->getActiveSheet();
        $rows = [];
        $headers = [];
        foreach ($activeSheet->getRowIterator() as $rowIndex => $row) {
            if ($associative === true && $rowIndex === 1) {
                foreach ($row->getCellIterator() as $cell) {
                    $headers[] = $cell->getValue();
                }
            } else {
                $rowArray = [];
                $cellCounter = 0;
                foreach ($row->getCellIterator() as $cell) {
                    if ($associative === true) {
                        $rowArray[$headers[$cellCounter]] = $cell->getValue();
                        $cellCounter++;
                    } else {
                        $rowArray[] = $cell->getValue();
                    }
                }
                $rows[] = $rowArray;
            }
        }
        return $rows;
    }

    /**
     * Convert Excel content to array of objects
     *
     * @return array
     */
    public function toObjects()
    {
        $encoded = $this->toJson();
        return json_decode($encoded);
    }
}
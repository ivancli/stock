<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 11/03/2018
 * Time: 11:28 PM
 */

namespace Stock\Repositories\Scrapers\Companies;


use Stock\Contracts\Scrapers\CompanyContract;

class ASX extends CompanyContract
{
    /**
     * Extract items from given content
     *
     * @return CompanyContract
     */
    public function extract()
    {

        if (is_null($this->content)) {
            throw new \RuntimeException('Content is not set.', 500);
        }

        $header = null;
        $rows = array_filter(explode("\n", $this->content));
        foreach ($rows as $index => $row) {
            if($index >= 2){
                if (is_null($header)) {
                    $header = array_filter(str_getcsv($row, ','));
                } else {
                    $companyRow = array_combine($header, array_filter(str_getcsv($row)));
                    $company = [
                        'name' => array_get($companyRow, 'Company name'),
                        'symbol' => array_get($companyRow, 'ASX code'),
                        'industry' => array_get($companyRow, 'GICS industry group') == 'n/a' ? null : array_get($companyRow, 'GICS industry group'),
                    ];
                    $this->companies [] = $company;
                }
            }
        }

        return $this;
    }
}
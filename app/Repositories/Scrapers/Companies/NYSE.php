<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 11/03/2018
 * Time: 11:28 PM
 */

namespace Stock\Repositories\Scrapers\Companies;


use Stock\Contracts\Scrapers\CompanyContract;

class NYSE extends CompanyContract
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

        $rows = str_getcsv($this->content, "\r\n");
        foreach ($rows as $row) {
            if (is_null($header)) {
                $header = array_filter(str_getcsv($row, ','));
            } else {
                $companyRow = array_combine($header, array_filter(str_getcsv($row, ',')));
                $company = [
                    'name' => array_get($companyRow, 'Name'),
                    'symbol' => array_get($companyRow, 'Symbol'),
                    'sector' => array_get($companyRow, 'Sector') == 'n/a' ? null : array_get($companyRow, 'Sector'),
                    'industry' => array_get($companyRow, 'industry') == 'n/a' ? null : array_get($companyRow, 'industry'),
                ];
                $this->companies [] = $company;
            }
        }

        return $this;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 13/03/2018
 * Time: 10:01 PM
 */

namespace Stock\Contracts\Models\Base;


use Stock\Contracts\Models\BaseContract;
use Stock\Models\Base\Company;
use Stock\Models\Base\Market;

/**
 * Class CompanyContract
 * @package Stock\Contracts\Models\Base
 */
abstract class CompanyContract extends BaseContract
{
    /**
     * CompanyContract constructor.
     * @param Company $company
     */
    public function __construct(Company $company)
    {
        parent::__construct($company);
    }
}
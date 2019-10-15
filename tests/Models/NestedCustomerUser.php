<?php

namespace Biscofil\LaravelSubmodels\Tests\Models;

use Biscofil\LaravelSubmodels\HasAppendedFields;

/**
 * Class NestedCustomerUser
 * @property mixed nested_customer_name
 * @package Biscofil\LaravelSubmodels\Tests\Models
 */
class NestedCustomerUser extends CustomerUser
{

    use HasAppendedFields;

    protected $table = 'users';

    private $appendedFillable = [
        'nested_customer_name'
    ];

    public function operation()
    {
        return "nested_customer";
    }

    public function getAppendedFillable()
    {
        return $this->appendedFillable;
    }

}
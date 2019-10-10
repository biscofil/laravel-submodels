<?php

namespace Biscofil\LaravelSubmodels\Test;


use Biscofil\LaravelSubmodels\HasAppendedFields;

class NestedCustomerUser extends CustomerUser
{

    use HasAppendedFields;

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
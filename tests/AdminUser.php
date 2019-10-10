<?php

namespace Biscofil\LaravelSubmodels\Test;

use Biscofil\LaravelSubmodels\HasAppendedFields;

class AdminUser extends BaseUser
{

    use HasAppendedFields;

    private $appendedFillable = [
        'admin_name'
    ];

    public function operation()
    {
        return "admin";
    }

    public function getAppendedFillable()
    {
        return $this->appendedFillable;
    }
}
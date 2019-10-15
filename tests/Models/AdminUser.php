<?php

namespace Biscofil\LaravelSubmodels\Tests\Models;

use Biscofil\LaravelSubmodels\HasAppendedFields;

/**
 * @property mixed admin_name
 */
class AdminUser extends BaseUser
{

    use HasAppendedFields;

    protected $table = 'users';

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
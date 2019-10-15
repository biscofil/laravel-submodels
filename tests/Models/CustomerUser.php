<?php

namespace Biscofil\LaravelSubmodels\Tests\Models;

use Biscofil\LaravelSubmodels\HasAppendedFields;
use Biscofil\LaravelSubmodels\HasSubModels;

/**
 * @property mixed customer_name
 * @property bool is_nested_customer
 */
class CustomerUser extends BaseUser
{

    use HasAppendedFields;
    use HasSubModels;

    protected $table = 'users';

    private $appendedFillable = [
        'customer_name',
        'is_nested_customer'
    ];

    private $appendedCasts = [
        'is_nested_customer' => 'bool'
    ];

    public function isNestedCustomer()
    {
        return $this->is_nested_customer;
    }

    /**
     * @param CustomerUser $model
     * @return string
     */
    public function getSubModelClass($model)
    {
        /** @var CustomerUser $model */
        if ($model->isNestedCustomer()) {
            return NestedCustomerUser::class;
        } else {
            return self::class;
        }
    }

    public function operation()
    {
        return "customer";
    }

    public function getAppendedFillable()
    {
        return $this->appendedFillable;
    }

}
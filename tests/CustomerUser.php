<?php

namespace Biscofil\LaravelSubmodels\Test;

use Biscofil\LaravelSubmodels\HasSubModels;
use Biscofil\LaravelSubmodels\HasAppendedFields;

/**
 * @property bool is_nested_customer
 */
class CustomerUser extends BaseUser
{

    use HasAppendedFields;
    use HasSubModels;

    private $appendedFillable = [
        'customer_name',
        'is_nested_customer'
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
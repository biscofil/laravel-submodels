<?php


use Biscofil\LaravelSubmodels\Tests\Models\NestedCustomerUser;

$factory->define(NestedCustomerUser::class, function () {
    return [
        'is_admin' => false,
        'customer_name' => 'demo nested',
        'is_nested_customer' => true,
        'nested_customer_name' => 'foo',
    ];
});
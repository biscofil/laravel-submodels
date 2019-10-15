<?php


use Biscofil\LaravelSubmodels\Tests\Models\CustomerUser;

$factory->define(CustomerUser::class, function () {
    return [
        'is_admin' => false,
        'customer_name' => 'demo',
        'is_nested_customer' => false,
    ];
});
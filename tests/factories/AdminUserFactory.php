<?php

use Biscofil\LaravelSubmodels\Tests\Models\AdminUser;

$factory->define(AdminUser::class, function () {
    return [
        'is_admin' => true,
        'admin_name' => 'foo',
    ];
});
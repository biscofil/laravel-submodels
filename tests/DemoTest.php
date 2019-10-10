<?php

namespace Biscofil\LaravelSubmodels\Test;

class DemoTest extends TestCase
{

    private $baseUser;
    private $adminUser;
    private $customerUser;
    private $nestedCustomerUser;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->baseUser = new BaseUser();

        $this->adminUser = new AdminUser();
        $this->customerUser = new CustomerUser();
        $this->nestedCustomerUser = new NestedCustomerUser();

    }

    public function testAdmin()
    {
        $expected = array_merge(
            $this->baseUser->getFillable(),
            $this->adminUser->getAppendedFillable()
        );
        $actual = $this->adminUser->getFillable();

        $this->assertEqualsCanonicalizing($expected, $actual);
    }

    public function testCustomer()
    {
        $expected = array_merge(
            $this->baseUser->getFillable(),
            $this->customerUser->getAppendedFillable()
        );
        $actual = $this->customerUser->getFillable();

        $this->assertEqualsCanonicalizing($expected, $actual);
    }

    public function testNestedCustomer()
    {
        $expected = array_unique(array_merge(
            $this->baseUser->getFillable(),
            $this->customerUser->getAppendedFillable(),
            $this->nestedCustomerUser->getAppendedFillable()
        ));
        $actual = $this->nestedCustomerUser->getFillable();

        $this->assertEqualsCanonicalizing($expected, $actual);
    }
}
<?php

namespace Biscofil\LaravelSubmodels\Tests\Features;

use Biscofil\LaravelSubmodels\Tests\Models\AdminUser;
use Biscofil\LaravelSubmodels\Tests\Models\BaseUser;
use Biscofil\LaravelSubmodels\Tests\Models\CustomerUser;
use Biscofil\LaravelSubmodels\Tests\Models\NestedCustomerUser;
use Biscofil\LaravelSubmodels\Tests\TestCase;

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

    public function testCreateAdmin()
    {

        /** @var AdminUser $admin */
        $admin = factory(AdminUser::class)->create();

        $adminFetched = BaseUser::find($admin->id);

        $this->assertEquals(get_class($adminFetched), AdminUser::class);

    }

    public function testCreateCustomer()
    {

        /** @var CustomerUser $admin */
        $customer = factory(CustomerUser::class)->create();

        /** @var NestedCustomerUser $customerFetched */
        $customerFetched = BaseUser::find($customer->id);

        $this->assertEquals(get_class($customerFetched), CustomerUser::class);

        $this->assertFalse($customerFetched->isNestedCustomer());
    }

    public function testCreateNestedCustomer()
    {

        /** @var CustomerUser $admin */
        $customer = factory(NestedCustomerUser::class)->create();

        /** @var NestedCustomerUser $customerFetched */
        $customerFetched = BaseUser::find($customer->id);

        $this->assertEquals(get_class($customerFetched), NestedCustomerUser::class);

        $this->assertTrue($customerFetched->isNestedCustomer());

    }

    public function testImplicitCreateAdmin()
    {

        /** @var BaseUser $user */
        $user = factory(BaseUser::class)->create([
            'is_admin' => true
        ]);

        /** @var BaseUser $userFetched */
        $userFetched = BaseUser::find($user->id);

        $this->assertEquals(get_class($userFetched), AdminUser::class);

        $this->assertTrue($userFetched->isAdmin());

    }


}
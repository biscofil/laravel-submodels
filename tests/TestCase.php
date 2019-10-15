<?php


namespace Biscofil\LaravelSubmodels\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     *
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->runMigrations();
        $this->withFactories(__DIR__ . '/factories');
    }

    /**
     * @param Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     *
     */
    public function runMigrations()
    {
        Schema::create('users', function ($table) {
            $table->increments('id');

            $table->boolean('is_admin')->default(false);
            $table->string('admin_name')->nullable();

            $table->string('customer_name')->nullable();

            $table->boolean('is_nested_customer')->default(false);;
            $table->string('nested_customer_name')->nullable();
        });

    }

}
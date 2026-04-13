<?php

namespace LaraOrVite\Validation\Tests;

use LaraOrVite\Validation\ValidationFixServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            ValidationFixServiceProvider::class,
        ];
    }
}
<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use CreatesUsers;

    protected function dispatch($job): void
    {
        $job->handle();
    }
}

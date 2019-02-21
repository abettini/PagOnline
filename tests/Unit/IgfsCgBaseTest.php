<?php

namespace Tests\Unit\Init;

use ReflectionClass;
use Illuminate\Support\Str;
use PagOnline\IgfsCgInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class IgfsCgBaseTest.
 */
abstract class IgfsCgBaseTest extends TestCase
{
    /**
     * @param $class
     * @param $name
     *
     * @throws \ReflectionException
     *
     * @return \ReflectionMethod
     */
    protected function getClassMethod($class, $name)
    {
        $class = new ReflectionClass($class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }

    /**
     * @param string $namespace
     *
     * @return \PagOnline\IgfsCgInterface
     */
    protected function makeIgfsCg($namespace): IgfsCgInterface
    {
        $class = new $namespace();
        $class->serverURL = 'https://server.com/UNI_CG_SERVICES/services';
        $class->tid = Str::random(16);
        $class->kSig = Str::random(24);
        $class->timeout = 15000;
        $class->shopID = Str::random(24);

        return $class;
    }
}

<?php

namespace PagOnline\Tests\Unit;

use PagOnline\Actions;
use PagOnline\Exceptions\ClassNotFoundException;
use PagOnline\IgfsCgFactory;
use PagOnline\Init\IgfsCgInit;
use PHPUnit\Framework\TestCase;

/**
 * Class IgfsCgFactoryTest.
 */
class IgfsCgFactoryTest extends TestCase
{
    /** @test */
    public function shouldCreateIgfsCgClass(): void
    {
        $igfsCgInit = new IgfsCgInit();
        $this->assertEquals($igfsCgInit, IgfsCgFactory::make(Actions::IGFS_CG_INIT));
    }

    /** @test */
    public function shouldRaiseClassNotFoundException(): void
    {
        $this->expectException(ClassNotFoundException::class);
        IgfsCgFactory::make('Not\Existent\Class\NameSpace');
    }
}

<?php

namespace Tests\Unit\Init;

use PagOnline\Actions;
use PagOnline\Init\IgfsCgInit;
use PagOnline\Exceptions\IgfsMissingParException;

/**
 * Class IgfsCgInitTest.
 */
class IgfsCgInitTest extends IgfsCgBaseTest
{
    /** @test */
    public function shouldChecksFieldsAndRaiseException()
    {
        $this->expectException(IgfsMissingParException::class);
        $foo = $this->getClassMethod(IgfsCgInit::class, 'checkFields');
        $obj = new IgfsCgInit();
        $foo->invoke($obj);
    }

    /** @test */
    public function shouldCheckFieldsAndPass()
    {
        /** @var \PagOnline\Init\IgfsCgInit $igfsCgInit */
        $igfsCgInit = $this->makeIgfsCg(Actions::IGFS_CG_INIT);
        $igfsCgInit->notifyURL = 'https://example.com/verify/';
        $igfsCgInit->errorURL = 'https://example.com/error/';
        $foo = $this->getClassMethod(IgfsCgInit::class, 'checkFields');

        $exception = null;
        try {
            $foo->invoke($igfsCgInit);
        } catch (\Exception $exception) {
        }

        $this->assertNull($exception);
    }
}

<?php

namespace PagOnline\Tests\Unit\PayByMail;

use PagOnline\Exceptions\IgfsMissingParException;
use PagOnline\PayByMail\IgfsCgPayByMailVerify;
use PagOnline\PayByMail\Requests\IgfsCgPayByMailVerifyRequest;
use PagOnline\Tests\Unit\IgfsCgBaseTest;

/**
 * Class IgfsCgInitTest.
 */
class IgfsCgPayByMailVerifyTest extends IgfsCgBaseTest
{
    protected $igfsCgClass = IgfsCgPayByMailVerify::class;
    protected $igfsCgRequest = IgfsCgPayByMailVerifyRequest::CONTENT;

    /** @test */
    public function shouldChecksFieldsAndRaiseExceptionMissingMailId(): void
    {
        /* @var \PagOnline\PayByMail\IgfsCgPayByMailVerify */
        $this->expectException(IgfsMissingParException::class);
        $this->expectExceptionMessage('Missing mailID');
        $foo = $this->getClassMethod('checkFields');
        $obj = $this->makeIgfsCg();
        $foo->invoke($obj);
    }

    /** @test */
    public function shouldCheckFieldsAndPass(): void
    {
        /** @var \PagOnline\Mpi\IgfsCgMpiAuth $obj */
        $obj = $this->makeIgfsCg();
        $foo = $this->getClassMethod('checkFields');
        $this->setIgfsRequiredParamenters($obj);
        $exception = null;

        try {
            $foo->invoke($obj);
        } catch (\Exception $exception) {
        }

        $this->assertNull($exception);
    }

    /** @test */
    public function shouldRaiseExceptionForMissingShopId(): void
    {
        $this->expectException(IgfsMissingParException::class);
        /** @var \PagOnline\Init\IgfsCgInit $obj */
        $obj = $this->makeIgfsCg();
        $obj->shopID = null;
        $foo = $this->getClassMethod('checkFields');
        $foo->invoke($obj);
    }

    protected function setIgfsRequiredParamenters(&$class): void
    {
        $class->mailID = 'mail@example.org';
    }
}

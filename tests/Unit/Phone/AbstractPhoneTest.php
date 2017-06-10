<?php

namespace App\Tests\Phone;

use App\Phone\AbstractPhone;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Phone\AbstractPhone
 */
class AbstractPhoneTest extends TestCase
{
    protected $abstractPhoneMock;

    public function setUp()
    {
        $this->abstractPhoneMock = $this->getMockBuilder(AbstractPhone::class)
                                        ->disableOriginalConstructor()
                                        ->setMethods(['isValid'])
                                        ->getMockForAbstractClass();
    }

    /**
     * @test
     *
     * @covers ::__construct
     * @covers ::getNumber
     * @covers ::getType
     */
    public function it_sets_number_and_type()
    {
        $this->abstractPhoneMock
            ->expects($this->once())
            ->method('isValid')
            ->willReturn(true);

        $this->abstractPhoneMock->__construct('1234567890', 'Mobile');

        $this->assertEquals('1234567890', $this->abstractPhoneMock->getNumber());
        $this->assertEquals('Mobile', $this->abstractPhoneMock->getType());
    }

    /**
     * @test
     *
     * @covers ::__construct
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Mobile phone invalid.
     */
    public function it_throws_exception_for_invalid_phone()
    {

        $this->abstractPhoneMock
            ->expects($this->once())
            ->method('isValid')
            ->willReturn(false);

        $this->abstractPhoneMock->__construct('1234567', 'Mobile');
    }
}

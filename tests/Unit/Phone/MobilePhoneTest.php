<?php

namespace App\Tests\Phone;

use App\Phone\MobilePhone;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Phone\MobilePhone
 */
class MobilePhoneTest extends TestCase
{
    protected $mobilePhone;

    public function setUp()
    {
        $this->mobilePhone = new MobilePhone('1234567890');
    }

    /**
     * @test
     *
     * @covers ::__construct
     * @covers ::getNumber
     * @covers ::getType
     * @covers ::isValid
     */
    public function it_sets_phone_and_type()
    {
        $mobilePhone = new MobilePhone('1234567890');

        $this->assertEquals('1234567890', $mobilePhone->getNumber());
        $this->assertEquals('Mobile', $mobilePhone->getType());
        $this->assertTrue($mobilePhone->isValid());
    }

    /**
     * @test
     *
     * @covers ::__construct
     * @covers ::isValid
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Mobile phone invalid.
     */
    public function it_throws_exception_if_phone_number_is_invalid()
    {
        new MobilePhone('12345678');
    }

    /**
     * @test
     *
     * @covers ::getNumber
     */
    public function it_gets_a_number()
    {
        $this->assertEquals('1234567890', $this->mobilePhone->getNumber());
    }

    /**
     * @test
     *
     * @covers ::getType
     */
    public function it_gets_a_type()
    {
        $this->assertEquals('Mobile', $this->mobilePhone->getType());
    }
}

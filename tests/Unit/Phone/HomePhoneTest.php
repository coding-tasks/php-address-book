<?php

namespace App\Tests\Phone;

use App\Phone\HomePhone;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Phone\HomePhone
 */
class HomePhoneTest extends TestCase
{
    protected $homePhone;

    public function setUp()
    {
        $this->homePhone = new HomePhone('1234567');
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
        $homePhone = new HomePhone('1234567');

        $this->assertEquals('1234567', $homePhone->getNumber());
        $this->assertEquals('Home', $homePhone->getType());
        $this->assertTrue($homePhone->isValid());
    }

    /**
     * @test
     *
     * @covers ::__construct
     * @covers ::isValid
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Home phone invalid.
     */
    public function it_throws_exception_if_phone_number_is_invalid()
    {
        new HomePhone('123456789');
    }

    /**
     * @test
     *
     * @covers ::getNumber
     */
    public function it_gets_a_number()
    {
        $this->assertEquals('1234567', $this->homePhone->getNumber());
    }

    /**
     * @test
     *
     * @covers ::getType
     */
    public function it_gets_a_type()
    {
        $this->assertEquals('Home', $this->homePhone->getType());
    }
}

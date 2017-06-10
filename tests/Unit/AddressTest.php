<?php

namespace App\Tests\Unit;

use App\Address;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Address
 */
class AddressTest extends TestCase
{
    protected $address;

    public function setUp()
    {
        $this->address = new Address('Sathorn, Soi Sribumphen');
    }

    /**
     * @test
     *
     * @covers ::__construct
     * @covers ::getAddress
     * @covers ::setAddress
     */
    public function it_sets_and_gets_address()
    {
        $this->assertEquals('Sathorn, Soi Sribumphen', $this->address->getAddress());

        $this->address->setAddress('Bangkok, Thailand');
        $this->assertEquals('Bangkok, Thailand', $this->address->getAddress());
    }
}

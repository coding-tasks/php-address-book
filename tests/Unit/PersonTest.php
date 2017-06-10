<?php

namespace App\Tests\Unit;

use App\Address;
use App\Email;
use App\Group;
use App\Person;
use App\Phone\HomePhone;
use App\Phone\MobilePhone;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Person
 */
class PersonTest extends TestCase
{
    protected $person;

    public function setUp()
    {
        $this->person = new Person('Ankit', 'Pokhrel');
    }

    /**
     * @test
     *
     * @covers ::__construct
     *
     * @expectedException \InvalidArgumentException
     * @exceptedExceptionMessage Invalid first name.
     */
    public function it_throws_exception_if_first_name_is_invalid()
    {
        new Person('');
    }

    /**
     * @test
     *
     * @covers ::__construct
     * @covers ::name
     *
     * @dataProvider \App\Tests\DataProviders\PersonDataProvider::getPersons
     */
    public function it_gets_full_name(string $name, Person $person)
    {
        $this->assertEquals($name, $person->name());
    }

    /**
     * @test
     *
     * @covers ::addGroup
     * @covers ::groups
     */
    public function it_adds_group()
    {
        $group1 = new Group('public');
        $group2 = new Group('private');

        $this->person->addGroup($group1)->addGroup($group2);

        $this->assertEquals([$group1, $group2], $this->person->groups());
    }

    /**
     * @test
     *
     * @covers ::addPhone
     * @covers ::phones
     */
    public function it_adds_phone()
    {
        $mobilePhone = new MobilePhone('1234567890');
        $homePhone   = new HomePhone('1234567');

        $this->person->addPhone($mobilePhone)->addPhone($homePhone);

        $this->assertEquals([$mobilePhone, $homePhone], $this->person->phones());
    }

    /**
     * @test
     *
     * @covers ::addEmail
     * @covers ::emails
     */
    public function it_adds_email()
    {
        $email1 = new Email('info@ankitpokhrel.com');
        $email2 = new Email('sales@ankitpokhrel.com');

        $this->person->addEmail($email1)->addEmail($email2);

        $this->assertEquals([
            md5($email1->getEmail()) => $email1,
            md5($email2->getEmail()) => $email2,
        ], $this->person->emails());
    }

    /**
     * @test
     *
     * @covers ::addAddress
     * @covers ::address
     */
    public function it_adds_address()
    {
        $address1 = new Address('Sathorn, Soi Sribumphen');
        $address2 = new Address('Bangkok, Thailand');

        $this->person->addAddress($address1)->addAddress($address2);

        $this->assertEquals([$address1, $address2], $this->person->address());
    }
}

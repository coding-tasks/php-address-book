<?php

namespace App\Tests\Unit;

use App\Group;
use App\Person;
use App\AddressBook;
use App\Tests\Fixtures\AddressBookFixture;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\AddressBook
 */
class AddressBookTest extends TestCase
{
    protected $addressBook;

    protected static $addressBookFixture;

    public static function setUpBeforeClass()
    {
        self::$addressBookFixture = new AddressBookFixture;
    }

    public function setUp()
    {
        $this->addressBook = new AddressBook('Book');
    }

    /**
     * @test
     *
     * @covers ::__construct
     * @covers ::getName
     * @covers ::setName
     */
    public function it_gets_and_sets_name()
    {
        $this->assertEquals('Book', $this->addressBook->getName());

        $newAddressBook = new AddressBook();
        $this->assertEquals('', $newAddressBook->getName());

        $newAddressBook->setName('Address Book');
        $this->assertEquals('Address Book', $newAddressBook->getName());
    }

    /**
     * @test
     *
     * @covers ::addContact
     * @covers ::contacts
     */
    public function it_adds_a_contact()
    {
        $person1 = new Person('Person1');

        $this->addressBook->addContact($person1);

        $this->assertEquals([$person1], $this->addressBook->contacts());
    }

    /**
     * @test
     *
     * @covers ::addContact
     * @covers ::contacts
     */
    public function it_adds_multiple_contacts()
    {
        $person1 = new Person('Person1');
        $person2 = new Person('Person2');
        $person3 = new Person('Person3');

        $this->addressBook->addContact($person1, $person2, $person3);

        $this->assertEquals([$person1, $person2, $person3], $this->addressBook->contacts());
    }

    /**
     * @test
     *
     * @covers ::addContact
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid contact.
     */
    public function it_throws_exception_if_contact_type_is_invalid()
    {
        $this->addressBook->addContact('invalid');
    }

    /**
     * @test
     *
     * @covers ::addGroup
     * @covers ::groups
     */
    public function it_adds_a_group()
    {
        $group1 = new Group('public');

        $this->addressBook->addGroup($group1);

        $this->assertEquals([$group1], $this->addressBook->groups());
    }

    /**
     * @test
     *
     * @covers ::addGroup
     * @covers ::groups
     */
    public function it_adds_multiple_groups()
    {
        $group1 = new Group('public');
        $group2 = new Group('private');
        $group3 = new Group('only me');

        $this->addressBook->addGroup($group1, $group2, $group3);

        $this->assertEquals([$group1, $group2, $group3], $this->addressBook->groups());
    }

    /**
     * @test
     *
     * @covers ::addGroup
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid group.
     */
    public function it_throws_exception_if_group_type_is_invalid()
    {
        $this->addressBook->addGroup('invalid');
    }

    /**
     * @test
     *
     * @covers ::findByName
     *
     * @dataProvider \App\Tests\DataProviders\CommonDataProvider::getDataForNameSearch
     */
    public function it_finds_person_by_name(string $query, int $resultCount)
    {
        $addressBook   = self::$addressBookFixture->getAddressBook();
        $persons = $addressBook->findByName($query);

        $this->assertEquals($resultCount, count($persons));
    }

    /**
     * @test
     *
     * @covers ::findByEmail
     *
     * @dataProvider \App\Tests\DataProviders\CommonDataProvider::getDataForEmailSearch
     */
    public function it_finds_person_by_email(string $query, int $resultCount)
    {
        $addressBook   = self::$addressBookFixture->getAddressBook();
        $persons = $addressBook->findByEmail($query);

        $this->assertEquals($resultCount, count($persons));
    }
}

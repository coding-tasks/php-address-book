<?php

namespace App\Tests\Unit;

use App\Group;
use App\Person;
use App\Tests\Fixtures\GroupFixture;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Group
 */
class GroupTest extends TestCase
{
    protected $group;

    protected static $groupFixture;

    public static function setUpBeforeClass()
    {
        self::$groupFixture = new GroupFixture;
    }

    public function setUp()
    {
        $this->group = new Group('public');
    }

    /**
     * @test
     *
     * @covers ::__construct
     *
     * @expectedException \InvalidArgumentException
     * @exceptedExceptionMessage Invalid group name.
     */
    public function it_throws_exception_if_first_name_is_invalid()
    {
        new Group('');
    }

    /**
     * @test
     *
     * @covers ::add
     * @covers ::members
     */
    public function it_adds_a_person()
    {
        $person = $this->createMock(Person::class);

        $person
            ->expects($this->once())
            ->method('addGroup')
            ->with($this->group)
            ->willReturn(null);

        $this->group->add($person);

        $this->assertEquals([$person], $this->group->members());
    }

    /**
     * @test
     *
     * @covers ::add
     * @covers ::members
     */
    public function it_adds_multiple_persons()
    {
        $person1 = $this->createMock(Person::class);
        $person2 = $this->createMock(Person::class);

        $person1
            ->expects($this->once())
            ->method('addGroup')
            ->with($this->group)
            ->willReturn(null);

        $person2
            ->expects($this->once())
            ->method('addGroup')
            ->with($this->group)
            ->willReturn(null);

        $this->group->add($person1, $person2);

        $this->assertEquals([$person1, $person2], $this->group->members());
    }

    /**
     * @test
     *
     * @covers ::add
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid person.
     */
    public function it_throws_exception_if_person_is_invalid()
    {
        $this->group->add('invalid');
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
        $group   = self::$groupFixture->getGroup();
        $persons = $group->findByName($query);

        $this->assertEquals($resultCount, count($persons));

        foreach ($persons as $person) {
            $this->assertTrue(in_array($group, $person->groups()));
        }
    }
}

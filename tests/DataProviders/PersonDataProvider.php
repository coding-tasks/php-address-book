<?php

namespace App\Tests\DataProviders;

use App\Person;

class PersonDataProvider
{
    /**
     * Get persons.
     *
     * @return array
     */
    public function getPersons() : array
    {
        return [
            ['name' => 'Aaron Hank', 'person' => new Person('Aaron', 'Hank')],
            ['name' => 'Anthony Piers', 'person' => new Person('Anthony', 'Piers')],
            ['name' => 'Bean Roy', 'person' => new Person('Bean', 'Roy')],
            ['name' => 'Aaron', 'person' => new Person('Aaron', '')],
            ['name' => 'Anthony Piers', 'person' => new Person('   Anthony   ', '   Piers   ')],
            ['name' => 'Bean', 'person' => new Person('Bean')],
        ];
    }
}

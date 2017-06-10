<?php

namespace App\Tests\Fixtures;

use App\Group;
use App\Person;

class GroupFixture
{
    /**
     * Get group object.
     *
     * @return Group
     */
    public function getGroup() : Group
    {
        $group = new Group('public');

        $persons = [
            ['Percy', 'Faith'],
            ['Tammy', 'Faye'],
            ['Arlene', 'Francis'],
            ['Hank', 'Francis'],
            ['Hank', 'Aaron'],
            ['Donna', 'Karen'],
            ['Ralph', 'Lauren'],
            ['Jim', 'Lee'],
            ['Jerry', 'Lewis'],
            ['Connie', 'Mack'],
        ];

        foreach ($persons as $p) {
            $person = new Person($p[0], $p[1]);

            $group->add($person);
        }

        return $group;
    }
}

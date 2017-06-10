<?php

namespace App\Tests\Fixtures;

use App\Email;
use App\Person;
use App\AddressBook;

class AddressBookFixture
{
    /**
     * Get group object.
     *
     * @return AddressBook
     */
    public function getAddressBook() : AddressBook
    {
        $addressBook = new AddressBook('Fixture');

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

            $addressBook->addContact($person);

            $email = strtolower($person->firstName) . '@' . strtolower($person->lastName) . '.com';

            $person->addEmail(new Email($email));
        }

        return $addressBook;
    }
}

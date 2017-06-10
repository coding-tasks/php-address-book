<?php

namespace App;

use InvalidArgumentException;

class AddressBook
{
    /** @var string $name Address book name */
    protected $name;

    /** @var array $contacts Contact list */
    protected $contacts = [];

    /** @var array $groups Groups in address book */
    protected $groups = [];

    /**
     * AddressBook constructor.
     *
     * @param string $name
     */
    public function __construct(string $name = '')
    {
        $this->name = $name;
    }

    /**
     * Add person to contact list.
     *
     * @param array $contacts
     *
     * @return $this
     */
    public function addContact(...$contacts)
    {
        foreach ($contacts as $person) {
            if ( ! is_a($person, Person::class)) {
                throw new InvalidArgumentException('Invalid contact.');
            }

            $this->contacts[] = $person;
        }

        return $this;
    }

    /**
     * Add groups.
     *
     * @param array $groups
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function addGroup(...$groups)
    {
        foreach ($groups as $group) {
            if ( ! is_a($group, Group::class)) {
                throw new InvalidArgumentException('Invalid group.');
            }

            $this->groups[] = $group;
        }

        return $this;
    }

    /**
     * Get all contacts.
     *
     * @return array
     */
    public function contacts() : array
    {
        return $this->contacts;
    }

    /**
     * Get all groups.
     *
     * @return array
     */
    public function groups() : array
    {
        return $this->groups;
    }

    /**
     * Get address book name.
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Set address book name.
     *
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Find member by first name, last name or both.
     *
     * @param string $name
     *
     * @return array
     */
    public function findByName(string $name) : array
    {
        $name = trim($name);

        if (empty($this->contacts) || empty($name)) {
            return [];
        }

        // trim all spaces from name and make it lowercase
        $pieces = array_map('trim', explode(' ', $name, 2));
        $name   = strtolower(implode(' ', $pieces));

        $results = [];
        foreach ($this->contacts as $contact) {
            if (in_array($name, array_map('strtolower', [
                $contact->firstName,
                $contact->lastName,
                $contact->name(),
            ]))) {
                $results[] = $contact;
            }
        }

        return $results;
    }

    /**
     * Find member by email.
     *
     * @param string $email
     *
     * @return array
     */
    public function findByEmail(string $email) : array
    {
        $email = strtolower(trim($email));

        if (empty($this->contacts) || empty($email) || strlen($email) < 3) {
            return [];
        }

        $isValidEmail = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        $key          = md5($email);

        $results = [];
        foreach ($this->contacts as $contact) {
            $emails = $contact->emails();

            if ($isValidEmail && isset($emails[$key])) {
                $results[] = $contact;
            } else {
                array_map(function ($e) use ($email, $contact, &$results) {
                    if (preg_match("/^$email/", $e->getEmail()) === 1) {
                        $results[] = $contact;
                    }
                }, $emails);
            }
        }

        return $results;
    }
}

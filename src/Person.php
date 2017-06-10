<?php

namespace App;

use App\Phone\PhoneInterface;
use InvalidArgumentException;

class Person
{
    /** @var string $firstName First Name */
    public $firstName;

    /** @var string $lastName Last Name */
    public $lastName;

    /** @var array $address Person addresses */
    protected $address = [];

    /** @var array $emails Person emails */
    protected $emails = [];

    /** @var array $phones Person phones */
    protected $phones = [];

    /** @var array $groups Groups this person is associated with */
    protected $groups = [];

    /**
     * Person constructor.
     *
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(string $firstName, string $lastName = '')
    {
        $firstName = trim($firstName);

        if ( ! $firstName) {
            throw new InvalidArgumentException('Invalid first name.');
        }

        $this->firstName = $firstName;
        $this->lastName  = trim($lastName);
    }

    /**
     * Get full name.
     *
     * @return string
     */
    public function name() : string
    {
        $name = $this->firstName;

        if ($this->lastName) {
            $name .= ' ' . $this->lastName;
        }

        return $name;
    }

    /**
     * Get groups this person is associated with.
     *
     * @return array
     */
    public function groups() : array
    {
        return $this->groups;
    }

    /**
     * Get phones.
     *
     * @return array
     */
    public function phones() : array
    {
        return $this->phones;
    }

    /**
     * Get emails.
     *
     * @return array
     */
    public function emails() : array
    {
        return $this->emails;
    }

    /**
     * Get addresses.
     *
     * @return array
     */
    public function address() : array
    {
        return $this->address;
    }

    /**
     * Set address.
     *
     * @param Address $address
     *
     * @return $this
     */
    public function addAddress(Address $address)
    {
        $this->address[] = $address;

        return $this;
    }

    /**
     * Set email.
     *
     * @param Email $email
     *
     * @return $this
     */
    public function addEmail(Email $email)
    {
        $this->emails[md5($email->getEmail())] = $email;

        return $this;
    }

    /**
     * Set phone.
     *
     * @param PhoneInterface $phone
     *
     * @return $this
     */
    public function addPhone(PhoneInterface $phone)
    {
        $this->phones[] = $phone;

        return $this;
    }

    /**
     * Set group.
     *
     * @param Group $group
     *
     * @return $this
     */
    public function addGroup(Group $group)
    {
        $this->groups[] = $group;

        return $this;
    }
}

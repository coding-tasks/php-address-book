<?php

namespace App;

class Address
{
    /** @var string $address */
    protected $address;

    /**
     * Address constructor.
     *
     * @param string $address
     */
    public function __construct(string $address)
    {
        $this->address = trim($address);
    }

    /**
     * Get address.
     *
     * @return string
     */
    public function getAddress() : string
    {
        return $this->address;
    }

    /**
     * Set address.
     *
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = trim($address);
    }
}

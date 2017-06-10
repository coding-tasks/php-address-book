<?php

namespace App\Phone;

class HomePhone extends AbstractPhone
{
    /**
     * HomePhone constructor.
     *
     * @param string $number
     */
    public function __construct(string $number)
    {
        parent::__construct($number, static::TYPE_HOME);
    }

    /**
     * {@inheritdoc}
     */
    public function isValid() : bool
    {
        return (bool) preg_match("/^[0-9]{7}$/", $this->number);
    }
}

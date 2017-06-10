<?php

namespace App\Phone;

class MobilePhone extends AbstractPhone
{
    public function __construct(string $number)
    {
        parent::__construct($number, static::TYPE_MOBILE);
    }

    public function isValid() : bool
    {
        return (bool) preg_match("/^[0-9]{10}$/", $this->number);
    }
}

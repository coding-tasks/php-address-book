<?php

namespace App\Phone;

use InvalidArgumentException;

abstract class AbstractPhone implements PhoneInterface
{
    const TYPE_MOBILE = 'Mobile';
    const TYPE_HOME   = 'Home';
    const TYPE_WORK   = 'Work';

    protected $number;
    protected $type;

    public function __construct(string $number, string $type)
    {
        $this->number = $number;
        $this->type   = $type;

        if ( ! $this->isValid()) {
            throw new InvalidArgumentException($this->getType() . ' phone invalid.');
        }
    }

    public function getNumber() : string
    {
        return $this->number;
    }

    public function getType() : string
    {
        return $this->type;
    }
}

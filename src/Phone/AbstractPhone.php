<?php

namespace App\Phone;

use InvalidArgumentException;

abstract class AbstractPhone implements PhoneInterface
{
    const TYPE_MOBILE = 'Mobile';
    const TYPE_HOME   = 'Home';
    const TYPE_WORK   = 'Work';

    /** @var string $number Phone number */
    protected $number;

    /** @var string $type Phone number type */
    protected $type;

    /**
     * AbstractPhone constructor.
     *
     * @param string $number
     * @param string $type
     */
    public function __construct(string $number, string $type)
    {
        $this->number = $number;
        $this->type   = $type;

        if ( ! $this->isValid()) {
            throw new InvalidArgumentException($this->getType() . ' phone invalid.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getNumber() : string
    {
        return $this->number;
    }

    /**
     * {@inheritdoc}
     */
    public function getType() : string
    {
        return $this->type;
    }
}

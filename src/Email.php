<?php

namespace App;

use InvalidArgumentException;

class Email
{
    /** @var string $email Email address */
    protected $email;

    public function __construct(string $email)
    {
        $this->email = strtolower(trim($email));

        if ( ! $this->isValid()) {
            throw new InvalidArgumentException('Invalid email.');
        }
    }

    /**
     * Get email address.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Check if email is valid.
     *
     * @return bool
     */
    public function isValid() : bool
    {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false;
    }
}

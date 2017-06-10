<?php

namespace App\Phone;

interface PhoneInterface
{
    /**
     * Get phone type.
     *
     * @return string
     */
    public function getType() : string;

    /**
     * Get phone number.
     *
     * @return string
     */
    public function getNumber() : string;

    /**
     * Validate phone number.
     *
     * @return bool
     */
    public function isValid() : bool;
}

<?php

namespace App\Phone;

interface PhoneInterface
{
    public function getType() : string;
    public function getNumber() : string;
    public function isValid() : bool;
}

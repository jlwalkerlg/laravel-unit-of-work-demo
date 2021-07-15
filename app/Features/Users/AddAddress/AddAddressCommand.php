<?php

namespace App\Features\Users\AddAddress;

class AddAddressCommand
{
    public int $userId;
    public string $line_1;
    public ?string $line_2;
    public string $city;
    public string $postcode;
}

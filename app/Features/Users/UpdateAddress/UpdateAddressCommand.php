<?php

namespace App\Features\Users\UpdateAddress;

class UpdateAddressCommand
{
    public int $userId;
    public int $addressId;
    public string $line_1;
    public ?string $line_2;
    public string $city;
    public string $postcode;
}

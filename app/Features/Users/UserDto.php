<?php

namespace App\Features\Users;

use App\Models\Address;
use App\Models\User;

class UserDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public array $addresses
    ) {
    }

    public static function fromModel(User $model)
    {
        return new self(
            id: $model->getId(),
            name: $model->getName(),
            email: $model->getEmail(),
            addresses: array_map(
                fn (Address $address) => AddressDto::fromModel($address),
                $model->getAddresses()
            )
        );
    }
}

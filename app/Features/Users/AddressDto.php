<?php

namespace App\Features\Users;

use App\Models\Address;

class AddressDto
{
    public function __construct(
        public int $id,
        public string $line_1,
        public ?string $line_2,
        public string $city,
        public string $postcode
    ) {
    }

    public static function fromModel(Address $model)
    {
        return new self(
            id: $model->getId(),
            line_1: $model->getLine1(),
            line_2: $model->getLine2(),
            city: $model->getCity(),
            postcode: $model->getPostcode(),
        );
    }
}

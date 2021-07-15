<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    private array $_addresses;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    /** @return Address[] */
    public function getAddresses(): array
    {
        return $this->_addresses ??= $this->addresses->all();
    }

    public function addAddress(
        string $line1,
        ?string $line2,
        string $city,
        string $postcode,
    ): Address {
        return $this->_addresses[] = Address::make(
            userId: $this->getId(),
            line1: $line1,
            line2: $line2,
            city: $city,
            postcode: $postcode,
        );
    }

    public function deleteAddress(int $addressId): Address
    {
        $address = $this->getAddress($addressId);

        if ($address === null) throw new Exception('Address not found.');

        $this->_addresses = array_filter(
            $this->_addresses,
            fn (Address $x) => $x !== $address
        );

        return $address;
    }

    public function hasAddress(int $addressId): bool
    {
        return $this->getAddress($addressId) !== null;
    }

    public function getAddress(int $addressId): ?Address
    {
        return collect($this->getAddresses())->first(
            fn (Address $address) => $address->getId() === $addressId
        );
    }

    public static function make(
        string $name,
        string $email,
        string $password
    ): self {
        return new self([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
    }
}

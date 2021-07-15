<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLine1(): string
    {
        return $this->line_1;
    }

    public function setLine1(string $line1): void
    {
        $this->line_1 = $line1;
    }

    public function getLine2(): ?string
    {
        return $this->line_2;
    }

    public function setLine2(?string $line2 = null): void
    {
        $this->line_2 = $line2;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getPostcode(): string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): void
    {
        $this->postcode = $postcode;
    }

    public static function make(
        int $userId,
        string $line1,
        ?string $line2,
        string $city,
        string $postcode,
    ): self {
        return new self([
            'user_id' => $userId,
            'line_1' => $line1,
            'line_2' => $line2,
            'city' => $city,
            'postcode' => $postcode,
        ]);
    }
}

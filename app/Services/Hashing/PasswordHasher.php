<?php

namespace App\Services\Hashing;

use Illuminate\Support\Facades\Hash;

class PasswordHasher implements PasswordHasherInterface
{
    public function hash(string $password): string
    {
        return Hash::make($password);
    }

    public function verify(string $password, string $hashed): string
    {
        return Hash::check($password, $hashed);
    }
}

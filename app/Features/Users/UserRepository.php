<?php

namespace App\Features\Users;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function findByEmail(string $email): ?User
    {
        return User::query()
            ->where(['email' => $email])
            ->with('addresses')
            ->first();
    }
}

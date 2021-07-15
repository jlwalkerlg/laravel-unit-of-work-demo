<?php

namespace App\Features\Users\RegisterUser;

use App\Events\UserRegisteredEvent;
use App\Features\Users\UserDto;
use App\Models\User;
use App\Services\Hashing\PasswordHasherInterface;
use App\Services\UnitOfWorkInterface;
use Illuminate\Validation\ValidationException;

class RegisterUserHandler
{
    public function __construct(
        private UnitOfWorkInterface $uow,
        private PasswordHasherInterface $passwordHasher
    ) {
    }

    public function handle(RegisterUserCommand $command)
    {
        $user = $this->uow->users()->findByEmail($command->email);

        if ($user !== null) {
            throw ValidationException::withMessages([
                'email' => 'The email has already been taken.',
            ]);
        }

        $user = User::make(
            name: $command->name,
            email: $command->email,
            password: $this->passwordHasher->hash($command->password),
        );

        $this->uow->add($user);
        $this->uow->dispatch(new UserRegisteredEvent($user));

        $this->uow->commit();

        return UserDto::fromModel($user);
    }
}

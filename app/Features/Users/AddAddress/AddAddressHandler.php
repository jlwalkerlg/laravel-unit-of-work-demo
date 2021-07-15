<?php

namespace App\Features\Users\AddAddress;

use App\Features\Users\UserDto;
use App\Services\UnitOfWorkInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AddAddressHandler
{
    public function __construct(private UnitOfWorkInterface $uow)
    {
    }

    public function handle(AddAddressCommand $command): UserDto
    {
        $user = $this->uow->users()->findById($command->userId);

        if ($user === null) throw new NotFoundHttpException('User not found.');

        $address = $user->addAddress(
            $command->line_1,
            $command->line_2,
            $command->city,
            $command->postcode
        );

        $this->uow->add($address);
        $this->uow->commit();

        return UserDto::fromModel($user);
    }
}

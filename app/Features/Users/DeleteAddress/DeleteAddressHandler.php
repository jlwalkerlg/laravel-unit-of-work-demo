<?php

namespace App\Features\Users\DeleteAddress;

use App\Features\Users\UserDto;
use App\Services\UnitOfWorkInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeleteAddressHandler
{
    public function __construct(private UnitOfWorkInterface $uow)
    {
    }

    public function handle(DeleteAddressCommand $command): UserDto
    {
        $user = $this->uow->users()->findById($command->userId);

        if ($user === null) throw new NotFoundHttpException('User not found.');

        if (!$user->hasAddress($command->addressId)) {
            throw new NotFoundHttpException('Address not found.');
        }

        $address = $user->deleteAddress($command->addressId);

        $this->uow->delete($address);
        $this->uow->commit();

        return UserDto::fromModel($user);
    }
}

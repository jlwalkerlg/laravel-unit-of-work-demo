<?php

namespace App\Features\Users\UpdateAddress;

use App\Features\Users\UserDto;
use App\Services\UnitOfWorkInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UpdateAddressHandler
{
    public function __construct(private UnitOfWorkInterface $uow)
    {
    }

    public function handle(UpdateAddressCommand $command): UserDto
    {
        $user = $this->uow->users()->findById($command->userId);

        if ($user === null) throw new NotFoundHttpException('User not found.');

        if (!$user->hasAddress($command->addressId)) {
            throw new NotFoundHttpException('Address not found.');
        }

        $address = $user->getAddress($command->addressId);
        $address->setLine1($command->line_1);
        $address->setLine2($command->line_2);
        $address->setCity($command->city);
        $address->setPostcode($command->postcode);

        $this->uow->update($address);
        $this->uow->commit();

        return UserDto::fromModel($user);
    }
}

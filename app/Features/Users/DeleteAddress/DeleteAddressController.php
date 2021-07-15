<?php

namespace App\Features\Users\DeleteAddress;

use App\Http\Controllers\Controller;

class DeleteAddressController extends Controller
{
    public function __construct(private DeleteAddressHandler $handler)
    {
    }

    public function __invoke(int $userId, int $addressId)
    {
        $command = new DeleteAddressCommand();
        $command->userId = $userId;
        $command->addressId = $addressId;

        $userDto = $this->handler->handle($command);

        return response()->json($userDto, 200);
    }
}

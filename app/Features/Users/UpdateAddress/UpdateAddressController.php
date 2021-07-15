<?php

namespace App\Features\Users\UpdateAddress;

use App\Http\Controllers\Controller;

class UpdateAddressController extends Controller
{
    public function __construct(private UpdateAddressHandler $handler)
    {
    }

    public function __invoke(int $userId, int $addressId, UpdateAddressRequest $request)
    {
        $command = new UpdateAddressCommand();
        $command->userId = $userId;
        $command->addressId = $addressId;
        $command->line_1 = $request->line_1;
        $command->line_2 = $request->line_2;
        $command->city = $request->city;
        $command->postcode = $request->postcode;

        $userDto = $this->handler->handle($command);

        return response()->json($userDto, 201);
    }
}

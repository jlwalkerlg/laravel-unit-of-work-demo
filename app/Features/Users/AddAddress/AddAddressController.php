<?php

namespace App\Features\Users\AddAddress;

use App\Http\Controllers\Controller;

class AddAddressController extends Controller
{
    public function __construct(private AddAddressHandler $handler)
    {
    }

    public function __invoke(int $userId, AddAddressRequest $request)
    {
        $command = new AddAddressCommand();
        $command->userId = $userId;
        $command->line_1 = $request->line_1;
        $command->line_2 = $request->line_2;
        $command->city = $request->city;
        $command->postcode = $request->postcode;

        $userDto = $this->handler->handle($command);

        return response()->json($userDto, 201);
    }
}

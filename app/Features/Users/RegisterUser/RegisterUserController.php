<?php

namespace App\Features\Users\RegisterUser;

use App\Http\Controllers\Controller;
use Faker\Generator;

class RegisterUserController extends Controller
{
    public function __construct(
        private RegisterUserHandler $handler,
        private Generator $faker
    ) {
    }

    public function __invoke(RegisterUserRequest $request)
    {
        $command = new RegisterUserCommand();
        $command->name = $request->name;
        $command->email = $request->email;
        $command->password = $request->password;

        $userDto = $this->handler->handle($command);

        return response()->json($userDto, 201);
    }
}

<?php

namespace App\Features\Users\GetUserById;

use App\Features\Users\UserDto;
use App\Http\Controllers\Controller;
use App\Models\User;

class GetUserByIdController extends Controller
{
    public function __invoke(User $user)
    {
        $userDto = UserDto::fromModel($user);

        return response()->json($userDto);
    }
}

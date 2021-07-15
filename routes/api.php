<?php

use App\Features\Users\AddAddress\AddAddressController;
use App\Features\Users\DeleteAddress\DeleteAddressController;
use App\Features\Users\GetUserById\GetUserByIdController;
use App\Features\Users\RegisterUser\RegisterUserController;
use App\Features\Users\UpdateAddress\UpdateAddressController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/users/{user}', GetUserByIdController::class);
Route::post('/users', RegisterUserController::class);
Route::post('/users/{userId}/addresses', AddAddressController::class);
Route::put('/users/{userId}/addresses/{addressId}', UpdateAddressController::class);
Route::delete('/users/{userId}/addresses/{addressId}', DeleteAddressController::class);

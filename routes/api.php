<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryApiController;

Route::post('/login', function() {
    $email = request()->email;
    $password = request()->password;

    if(!$email or !$password) {
        return response ( ['msg' => 'email and password required'], 400);
    }

    $user = User::where('email', $email)->first();
    if($user) {
        if(password_verify($password, $user->password)) {
            return $user->createToken('api')->plainTextToken;

        }
    }
    return response (['msg' => 'Invalid emai or password'], 401);

});

Route::apiResource('/categories',CategoryApiController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


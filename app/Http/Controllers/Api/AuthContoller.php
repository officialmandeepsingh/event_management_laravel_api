<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthContoller extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            "email" => "required|email",
            "password" => "required|string"
        ]);

        $user = User::where("email", $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages(["email" => "The email is incorrect"]);
        }
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages(["email" => "The email is incorrect"]);
        }
        $token = $user->createToken('api_token')->plainTextToken;

        // $data = [
        //     'user' => $user,
        //     'token' => $token,
        // ];

        return new AuthResource([$user, $token]);
        // return response()->json([
        //     "user" => ($user),
        //     "token" => $token
        // ]);
    }
}

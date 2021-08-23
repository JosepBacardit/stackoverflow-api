<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function register() {
        $fields = $this->validateUser();

        $user = $this->createUser($fields);

        $token = $user->createToken('factorenergia_token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }


    public function login() {
        $fields = $this->validateUserLogin();

        //Check email
        $user = User::where('email', $fields['email'])->first();

        //Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad credentials'
            ], 401);
        }

        $token = $user->createToken('factorenergia_token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }

    public function logout() {
        auth()->user()->tokens()->delete();

        $response = [
            'message' => 'Logged out'
        ];
        return response($response, 200);
    }


    /** PRIVATE FUNCTIONS */
    private function validateUser() {
        return $this->request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);
    }

    private function validateUserLogin() {
        return $this->request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
    }

    private function createUser($fields) {
        return User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);
    }
}

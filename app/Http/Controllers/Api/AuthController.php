<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('name', $data['name'])->first();
        if(!$user || !Hash::check($data['password'], $user->password)){
            return response(["msg" => 'incorrect name or password'], 401);
        }

        $token = $user->createToken('apiToken')->plainTextToken;
        return response(["userName" => $user->name, "token" => $token], 201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response(["msg" => "user loged out" ]);

    }
}

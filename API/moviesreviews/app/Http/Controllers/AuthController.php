<?php

namespace App\Http\Controllers;

use App\Models\AccessToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|unique:user',
                'password' => 'required|min:5',
                'name' => 'required',
                'username' => 'required|unique:user'
            ],
            [
                'required' => 'O campo :attribute é obrigatorio',
                'unique' => 'Já existe um :attribute com esse valor',
                'min' =>  'A senha precisa ter no minimo 6 caracteres'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid properties',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create($request->all());
        return response()->json(['token' => User::generateToken($user)], 201);
    }

    public function signin(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required',
                'password' => 'required|min:6',
            ],
            [
                'required' => 'O campo :attribute é obrigatorio',
                'min' =>  'A senha precisa ter no minimo 6 caracteres'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid properties',
                'errors' => $validator->errors()
            ], 422);
        }

        $userExists = User::where('email', $request->email)
            ->where('password', hash('sha256', $request->password))
            ->first();

            // return hash('sha256', $request->password);

        if (is_null($userExists)) {
            $userExists = User::where('email', $request->email)
                ->where('password', $request->password)
                ->first();

            if (is_null($userExists)) {
                return response()->json(['message' => 'Invalid email or password'], 422);
            }

            $userExists->password = $request->password;
            $userExists->save();
        }

        return response()->json(['token' => User::generateToken($userExists)]);
    }

    public function signout(Request $request)
    {
        $token = $request->bearerToken();

        $getUserId = AccessToken::where('tokenString', $token)->first();
        AccessToken::where('userId', $getUserId->userId)->delete();

        return response()->json([], 204);
    }
}

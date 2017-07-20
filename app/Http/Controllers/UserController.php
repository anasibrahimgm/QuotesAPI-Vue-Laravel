<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserSignUpRequest;
use App\Http\Requests\UserSignInRequest;

use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class UserController extends Controller
{

    public function signup(UserSignUpRequest $request)
    {
      $user = new User([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
      ]);

      $user->save();

      return response()->json([
        'message' => 'Successfully created user',
      ], 201);

    }

    public function signin(UserSignInRequest $request)
    {
      $credentials = $request->only('email', 'password');

      try {
        if(!$token = JWTAuth::attempt($credentials)) {
          return response()->json([
            'error' => 'Invalid Credentials',
          ], 401);
        }
      }
      catch (JWTException $e) {
        return response()->json([
          'error' => 'Could not Create Token',
        ], 500);
      }

      return response()->json([
        'token' => $token,
      ], 200);

    }
}

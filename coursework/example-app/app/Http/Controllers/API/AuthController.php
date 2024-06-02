<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(UserStoreRequest $request)
    {


        $user = User::create($request->validated());

        $accessToken = $user->createToken('authToken')->plainTextToken;

        return response(['messages'=>'Пользователь успешно создан','access_token' => $accessToken],200);
    }


    public function login(UserStoreRequest $request)
    {

        if (!Auth::attempt($request->validated())) {
            return response(['message' => 'Не верные данные'],401);
        }else{

            $user=Auth::user();
            $id_role=$user->id_role;
            $accessToken = auth()->user()->createToken('authToken')->plainTextToken;

            return response(['user' => new UserResource(auth()->user()), 'access_token' => $accessToken,'id_role'=>$id_role], 200);
        }
    }

    public function logout(Request $request)
        {
            $request->user()->currentAccessToken()->delete();

            return response()->json(['message' => 'Вы вышли']);
    }





}

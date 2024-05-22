<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        if ($user->id !== auth()->user()->id) {
            return response()->json(['message' => 'Не прошли проверку подлинности'], 401);
        }

        return response()->json([new UserResource($user)],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);


        if (!$user) {
            return response()->json(['message' => 'Нет такого пользователя'], 404);
        }

        // Проверяем, соответствует ли пользователь, пытающийся обновить данные, текущему аутентифицированному пользователю
        if ($user->id !== auth()->user()->id) {
            return response()->json(['message' => 'Отказано в доступе'], 401);
        }

        $user->update($request->all());

        return response()->json(['message' => 'Данные пользователя были изменены', new UserResource($user)],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuideStoreRequest;
use App\Http\Resources\GuideResource;
use Illuminate\Http\Request;

use App\Models\Guide;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuideStoreRequest $request)
    {
        $create_guide = Guide::create($request->validated());

        return new GuideResource($create_guide);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GuideStoreRequest $request, $id)
    {
        // Получаем экземпляр модели Tour
        $guide =  new GuideResource(Guide::findOrFail($id));

        // Обновляем атрибуты модели с использованием данных из запроса
        $guide->update($request->validated());

        // Возвращаем успешный ответ или что-то еще по вашему усмотрению
        return response()->json(['message' => 'Данные гида изменены', 'guide'=>$guide], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $guide =  new GuideResource(Guide::findOrFail($id));

        $guide->delete();

        return response(null, 204);
    }
}

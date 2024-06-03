<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuideStoreRequest;
use App\Http\Resources\GuideResource;
use App\Models\Region;
use App\Models\Tour;
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
        $guides = Guide::all();
        $result = [];

        foreach ($guides as $guide) {
            $region = Region::where('id', $guide->id_region)->first();
            $result[] = [
                'guide' => new GuideResource($guide),
                'region' => $region ? $region->name : null
            ];
        }

        return response()->json($result, 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuideStoreRequest $request)
    {
        $image = $request->file('photo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('photos'), $imageName);
        $photo= 'public/photos/' . $imageName;

        $guid = Guide::create($request->validated());

        $guid->photo = $photo;

        $guid->save();



        return response()->json(['message' => 'Гид был успешно создан','guid'=>new GuideResource($guid)],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $guid = Guide::findOrFail($id);
        $region = Region::findOrFail($guid->id_region);
        $tour= Tour::where('id_guid',$id)->pluck('name');
        return response()->json(['guid'=>new GuideResource($guid),'name_region' => $region->name,'tour'=>$tour],200);
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
        return response()->json(['message' => 'Данные гида изменены', 'guide'=>new GuideResource($guide)], 200);
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






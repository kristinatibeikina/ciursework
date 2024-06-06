<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\HousingStoreRequest;
use App\Http\Resources\HousingResource;
use App\Models\Housing;
use App\Models\Region;
use Illuminate\Http\Request;

class HousingTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return HousingResource::collection(Housing::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HousingStoreRequest $request)
    {
        $validated=$request->validated();


        $photos = [];

        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $image) {
                if (is_file($image)) { // Проверяем, что $image - это файл
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('photos'), $imageName);
                    $photos= 'public/photos/' . $imageName; // Сохраняем путь к файлу
                }
            }
        }


        $housing = new Housing();
        $housing->name = $validated['name'];
        $housing->photo = json_encode($photos);  // Сохранение JSON строки с путями к фото
        $housing->address = $validated['address'];
        $housing->id_region = $validated['id_region'];
        $housing->description = $validated['description'];
        $housing->save();

        return response()->json(['message' => 'Отель был успешно создан', 'housing' =>new HousingResource($housing)], 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $housing = new HousingResource(Housing::findOrFail($id));
        $region = Region::findOrFail($housing->id_region);
        return response()->json(['housing'=>new HousingResource($housing),'name_region' => $region->name],200);
    }

    public function show_admin($id)
    {
        $housing = new HousingResource(Housing::findOrFail($id));
        $region = Region::findOrFail($housing->id_region);
        return response()->json(['housing'=>new HousingResource($housing),'name_region' => $region->name],200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guide =  new HousingResource(Housing::findOrFail($id));

        $guide->delete();

        return response(null, 204);
    }
}

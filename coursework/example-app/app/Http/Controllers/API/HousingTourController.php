<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\HousingStoreRequest;
use App\Http\Resources\HousingResource;
use App\Models\Housing;
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
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'required|array',
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'required|string|max:255',
            'id_region' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $photos = [];

        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $image) {
                if (is_file($image)) { // Проверяем, что $image - это файл
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('photos'), $imageName);
                    $photos[] = 'photos/' . $imageName; // Сохраняем путь к файлу
                }
            }
        }

        $housing = Housing::create([
            'name' => $request->input('name'),
            'photo' => json_encode($photos), // Сохраняем пути в виде JSON
            'address' => $request->input('address'),
            'id_region' => $request->input('id_region'),
            'description' => $request->input('description'),
        ]);

        return response()->json([
            'message' => 'Housing created successfully',
            'housing' => $housing,
        ], 201);
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
        if(! $housing){
            return response()->json(['message'=>'Данного отеля не существует не существует'],401);
        }
        return $housing;
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

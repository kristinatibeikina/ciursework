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
        $validatedData = $request->validated();

        $image = $request->file('photo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('photos'), $imageName);

        $housing = Housing::create([
            'name' => $validatedData['name'],
            'photo' => $imageName,
            'address' => $validatedData['address'],
            'id_region' => $validatedData['id_region'],
            'description' => $validatedData['description'],
        ]);

        return response()->json(['message' => 'Tour created successfully']);
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

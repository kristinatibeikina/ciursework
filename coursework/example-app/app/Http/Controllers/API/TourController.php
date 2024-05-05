<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourStoreRequest;
use App\Http\Resources\TourResource;
use Illuminate\Http\Request;
use App\Models\Tour;
class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return TourResource
     */
    public function index()
    {
        return TourResource::collection(Tour::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourStoreRequest $request)
    {
       $create_tour=Tour::create($request->validated());

       return new TourResource($create_tour);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tour = new TourResource(Tour::findOrFail($id));
        if(! $tour){
            return response()->json(['message'=>'Данного тура не существует'],401);
        }
        return $tour;
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
        //
    }
}

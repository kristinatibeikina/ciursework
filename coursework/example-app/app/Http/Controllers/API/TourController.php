<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourStoreRequest;
use App\Http\Resources\TourResource;
use App\Models\Guide;
use App\Models\Housing;
use App\Models\Photo_tour;
use App\Models\Region;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\Tour;
use Illuminate\Support\Carbon;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return TourResource
     */
    public function index()
    {
        $tours = TourResource::collection(Tour::all());
        foreach ($tours as $tour){
            $region = Region::findOrFail($tour->id_region)->name;

        }
        return response()->json(['tour' => $tours], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourStoreRequest $request)
    {

        $image = $request->file('photo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('photos'), $imageName);


        $tour = Tour::create($request->validated());


        $tour->photo = $imageName;

        $tour->save();


        return response()->json(['message' => 'Отель был успешно создан'], 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $tour = new TourResource(Tour::with('list')->findOrFail($id));
        $region = Region::findOrFail($tour->id_region)->name;
        $guide = Guide::findOrFail($tour->id_guid)->name;
        $housing = Housing::findOrFail($tour->id_housing)->name;
        return response()->json(['tour'=>new TourResource($tour),'housing' => $housing,'region' => $region,'guide' => $guide],200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TourStoreRequest $request, $id)
    {
        // Получаем экземпляр модели Tour
        $tour =  new TourResource(Tour::findOrFail($id));

        // Обновляем атрибуты модели с использованием данных из запроса
        $tour->update($request->validated());

        // Возвращаем успешный ответ или что-то еще по вашему усмотрению
        return response()->json(['message' => 'Данные тура изменены', 'tour'=>new TourResource($tour)], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $guide =  new TourResource(Tour::findOrFail($id));

        $guide->delete();

        return response(null, 204);
    }


    public function search(Request $request)
    {
        $query = $request->get('query');

        $results = Tour::where('name', 'like', '%' . $query . '%')->get();
        return response()->json(TourResource::collection($results),200);
    }

    public function filter(Request $request)
    {
        $status = $request->input('id_status');
        $date_start = $request->input('date_tart');
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');


        $query = Tour::query();

        if ($status) {
            $query->where('id_status', $status);
        }
        if ($max_price||$min_price ) {
            $query->whereBetween('price', [$min_price, $max_price])->get();
        }


        if ($date_start) {
            $date_start = Carbon::parse($date_start)->toDateString();
            $query->whereDate('date_start', $date_start);
        }

        $tours = $query->get();

        return response()->json(TourResource::collection($tours),200);
    }


}

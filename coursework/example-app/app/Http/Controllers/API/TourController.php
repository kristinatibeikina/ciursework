<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourStoreRequest;
use App\Http\Resources\TourResource;
use App\Models\Photo_tour;
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

        $image = $request->file('photo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('photos'), $imageName);


        $tour = Tour::create($request->validated());

        $tour->photo = $imageName;

        $tour->save();


        return response()->json(['message' => 'Отель был успешно создан', 'tour' => new TourResource($tour)], 200);
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
    public function update(TourStoreRequest $request, $id)
    {
        // Получаем экземпляр модели Tour
        $tour =  new TourResource(Tour::findOrFail($id));

        // Обновляем атрибуты модели с использованием данных из запроса
        $tour->update($request->validated());

        // Возвращаем успешный ответ или что-то еще по вашему усмотрению
        return response()->json(['message' => 'Данные тура изменены', 'tour'=>$tour], 200);
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
        return response()->json($results);
    }

    public function filter(Request $request)
    {
        $status = $request->input('status');
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

        return response()->json(['tours' => $tours]);
    }


}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookedTourRequest;
use App\Http\Resources\BookedTourResource;
use App\Models\Booked_tours;
use App\Models\Status_application;
use App\Models\Tour;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookedTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
             //вывлж всех заказов для админа

        $books = Booked_tours::all();
        $booked_user = [];

        foreach ($books as $booked) {
            $user = User::where('id', $booked->id_user)->first();
            $tour = Tour::where('id', $booked->id_tour)->first();
            $status_application = Status_application::where('id', $booked->id_status_application)->first();
            $booked_user[] = [
                'booked' => new BookedTourResource($booked),
                'user' => $user? $user->name : null,
                'tour' => $tour? $tour->name: null,
                'status_application' => $status_application? $status_application->name: null,
            ];
        }

        return response()->json($booked_user, 200);

    }

    public function index_user()
    {

        $user = Auth::user();
        $id_user=$user->id;

        return BookedTourResource::collection(Booked_tours::where('id_user',$id_user)->get());   //вывлж всех заказов для админа
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookedTourRequest $request)
    {


        $booked_tours=Booked_tours::create($request->validated());

        $booked_tours->id_user=Auth::id();
        $booked_tours->date_application=Carbon::now();

        //Расчет стоимоти тура
        $count_user=$booked_tours->count_children;
        $count_user+=$booked_tours->count_adults;
        $tour = Tour::where('id',$booked_tours->id_tour)->first();
        $price=$tour->price;
        $booked_tours->price_end=$count_user*$price;
        $booked_tours->save();
        return response()->json(['message' => 'Тур успешно создан', 'tour'=>new BookedTourResource($booked_tours)], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booked = Booked_tours::findOrFail($id);
        $user = User::findOrFail($booked->id_user);
        $tour = Tour::findOrFail($booked->id_tour);
        $status_application = Status_application::where('id', $booked->id_status_application)->first
        return response()->json(['guid'=> new BookedTourResource($booked),'user' => $user->name,'tour'=>$tour->name],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookedTourRequest $request, $id)
    {
        // Получаем экземпляр модели Tour

        $tour =  Booked_tours::findOrFail($id);
        $tour->id_employees=Auth::id();
        // Обновляем атрибуты модели с использованием данных из запроса
        $tour->update($request->validated());

        // Возвращаем успешный ответ или что-то еще по вашему усмотрению
        return response()->json(['message' => 'Данные тура изменены', 'tour'=>new BookedTourResource($tour)], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guide =  new BookedTourResource(Booked_tours::findOrFail($id));

        $guide->delete();

        return response(null, 204);
    }
}

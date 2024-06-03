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
            $status_application=$status_application? $status_application->name: null;
            if($status_application != null){
                $booked_user[] = [
                    'booked' => $booked->id,
                    'user' => $user? $user->name : null,
                    'surname' => $user? $user->surname : null,
                    'tour' => $tour? $tour->name: null,
                    'date_start' => $tour? $tour->date_start: null,
                    'date_end' => $tour? $tour->date_end: null,
                    'status_application' => $status_application,
                ];

            }

        }

        return response()->json($booked_user, 200);

    }

    public function index_user()
    {
        $result = [];
        $user = Auth::user();
        $id_user=$user->id;
        $books = Booked_tours::where('id_user',$id_user)->get();
        if(is_null($books)){
            return response()->json(['message'=>'У вас нет заказов'],200);
        }
        foreach ($books as $booked) {
            $tour = Tour::where('id', $booked->id_region)->first();
            $user = User::where('id', $booked->id_user)->first();
            if(!$booked->id_employees){
                $result[] = [
                    'booked'=>BookedTourResource::collection($books),
                    'user_name'=>$user ? $user->name : null,
                    'user_surname'=>$user ? $user->surname : null,
                    'tour_name' => $tour ? $tour ->name : null,
                    'tour_end' => $tour ? $tour ->date_end : null,
                    'date_start' => $tour ? $tour ->date_start : null,

                ];
            }else{
                $employees=User::where('id',$booked ->id_employees)->first();
                $result[] = [
                    'booked'=>BookedTourResource::collection($books),
                    'user_name'=>$user ? $user->name : null,
                    'user_surname'=>$user ? $user->surname : null,
                    'tour_name' => $tour ? $tour ->name : null,
                    'tour_end' => $tour ? $tour ->date_end : null,
                    'date_start' => $tour ? $tour ->date_start : null,
                    'employees' => $employees ? $employees ->name : null,
                    'response' => $booked ? $booked->response : null,
                    ];

            }

        }

        return response()->json($result,200);   //вывлж всех заказов для админа
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
        $status_application = Status_application::findOrFail($booked->id_status_application);
        $employees = User::findOrFail($booked->id_employees);
        return response()->json(['guid'=> new BookedTourResource($booked),'user' => $user->name,
            'tour'=>$tour->name,
            'status_application'=>$status_application->name,
            'employees'=> $employees->name,
            'surname'=>$user->surname],200);
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

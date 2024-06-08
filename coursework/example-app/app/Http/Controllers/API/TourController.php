<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourStoreRequest;
use App\Http\Resources\FeedbackResource;
use App\Http\Resources\ProgramTourResource;
use App\Http\Resources\TourResource;
use App\Models\Feedback;
use App\Models\Guide;
use App\Models\Housing;
use App\Models\Photo_tour;
use App\Models\Program_tour;
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
        $tours = Tour::all();
        $result = [];

        foreach ($tours as $tour) {
            $region = Region::where('id', $tour->id_region)->first();
            $status = Status::where('id', $tour->id_status)->first();
            $result[] = [
                'tour' => new TourResource($tour),
                'region' => $region ? $region->name : null,
                'status' => $status ? $status->name : 'Статус не определен'
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
    public function store(TourStoreRequest $request)
    {

        $image = $request->file('photo');
        $path = $image->store('photos', 'public');

        $tour = Tour::create($request->validated());


        $tour->photo = $path;

        $tour->save();


        return response()->json(['message' => 'Тур был успешно создан'], 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Получаем тур как объект
        $tour = Tour::find($id);
        $status_tour = Status::where('id', $tour->id_status)->first();
        $status= $status_tour ? $status_tour->name : null;
        // Проверяем, найден ли тур
        if (!$tour) {
            return response()->json(['error' => 'Тур не найден'], 404);
        }

        // Проверка наличия гида
        if ($tour->id_guid === null) {
            $guide = 'Гид не выбран';
        } else {
            $guide = Guide::find($tour->id_guid);
            $guide = $guide ? $guide->name : 'Гид не найден';
        }

        // Проверка наличия отеля
        if ($tour->id_housing === null) {
            $housing = 'Отель не выбран';
        } else {
            $housing = Housing::find($tour->id_housing);
            $housing = $housing ? $housing->name : 'Отель не найден';
        }

        // Проверка программы тура
        $program = Program_tour::where('id_tour', $id)->first();
        if (!$program || !$program->day) {
            $program = 'Программа не создана';
        } else {
            $program = $program->name; // Предполагается, что у Program_tour есть свойство name
        }

        // Получение региона
        $region = Region::find($tour->id_region);
        $region = $region ? $region->name : 'Регион не найден';

        // Получение отзывов
        $feedback = Feedback::where('id_tour', $id)->first();
        $feedbackResource = $feedback ? new FeedbackResource($feedback) : null;

        // Возвращаем ответ
        return response()->json([
            'tour' => new TourResource($tour),
            'housing' => $housing,
            'region' => $region,
            'guide' => $guide,
            'feedback' => $feedbackResource,
            'program' => $program,
            'status' => $status
        ], 200);
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
        $tour =  Tour::findOrFail($id);

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

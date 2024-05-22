<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\FeedbackStoreRequest;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FeedbackResource::collection(Feedback::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeedbackStoreRequest $request)
    {
        $validated = $request->validated();
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


        $user = Auth::user();
        $feedback = new Feedback();
        $feedback->id_tour = $validated['id_tour'];
        $feedback->photo = json_encode($photos);  // Сохранение JSON строки с путями к фото
        $feedback->comment = $validated['comment'];
        $feedback->count_stars = $validated['count_stars'];
        $feedback->date_published = Carbon::now();
        $feedback->id_user = $user->id;
        $feedback->save();

        return response()->json(['message' => 'Комментарий был успешно создан','feedback'=> new FeedbackResource($feedback),'name_user'=>$user->name],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

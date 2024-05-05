<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TourController;
use App\Http\Controllers\API\PlaceTourController;
use App\Http\Controllers\API\GuideController;
use App\Http\Controllers\API\FeedbackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Защищенный маршрут для получения информации о пользователе
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Auth
Route::post('/register',[AuthController::class, 'register']);

Route::post('/login',[AuthController::class, 'login']);


//Tour
Route::get('/tour',[TourController::class, 'index']);

Route::get('/tour/{id}',[TourController::class, 'show']);

Route::post('/tour/create',[TourController::class, 'store']);   //Создание нового тура

Route::put('/tour/update/{id}',[TourController::class, 'update']);   //Изменение тура

//Place_tour

Route::get('/place',[PlaceTourController::class, 'index']);//Вывод всех городов

Route::get('/place/{id}',[PlaceTourController::class, 'show']);//вывод города и всех туров относящихся к нему

Route::post('/place/create',[PlaceTourController::class, 'store']);  //Создание нового города

//Guide

Route::post('/guide/create',[GuideController::class, 'store']);  //Создание нового гида

//Feedback

Route::post('/feedback/create',[FeedbackController::class, 'store']);  //Создание нового комментария

Route::group(['middleware'=>['auth:sanctum']],function (){

});

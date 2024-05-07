<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TourController;
use App\Http\Controllers\API\PlaceTourController;
use App\Http\Controllers\API\GuideController;
use App\Http\Controllers\API\FeedbackController;
use App\Http\Controllers\API\BookedTourController;
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

Route::delete('/tour/delete/{id}',[TourController::class, 'destroy']);   //Удаление тура

Route::get('/search',[TourController::class, 'search']);  //Поиск по названию тура (в форме передовать id= 'query' );

Route::get('/filter',[TourController::class, 'filter']);  //;


//Place_tour

Route::get('/place',[PlaceTourController::class, 'index']);//Вывод всех городов

Route::get('/place/{id}',[PlaceTourController::class, 'show']);//вывод города и всех туров относящихся к нему

Route::post('/place/create',[PlaceTourController::class, 'store']);  //Создание нового города

//Guide

Route::post('/guide/create',[GuideController::class, 'store']);  //Создание нового гида

Route::put('/guide/update/{id}',[GuideController::class, 'update']);  //Изиенение данных гида

Route::delete('/guide/delete/{id}',[GuideController::class, 'destroy']);  //Удаление гида

//Feedback

Route::post('/feedback/create',[FeedbackController::class, 'store']);  //Создание нового комментария


//Booked_tours


Route::get('/booked',[BookedTourController::class, 'index']);  //Отображение заказанных туров

Route::post('/booked/create',[BookedTourController::class, 'show']);  //Создание заказа

Route::put('/booked/update/{id}',[BookedTourController::class, 'update']);  //Ихменение данных заказа

Route::group(['middleware'=>['auth:sanctum']],function (){

});

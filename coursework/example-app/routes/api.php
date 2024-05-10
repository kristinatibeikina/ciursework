<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\HousingTourController;
use App\Http\Controllers\API\TourController;
use App\Http\Controllers\API\RegionController;
use App\Http\Controllers\API\GuideController;
use App\Http\Controllers\API\FeedbackController;
use App\Http\Controllers\API\BookedTourController;
use App\Http\Resources\RegionResource;
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
Route::get('/tour',[TourController::class, 'index']); //Вывод всеъх туров  *

Route::get('/tour/{id}',[TourController::class, 'show']); //Вывод одного тура *

Route::post('/tour/create',[TourController::class, 'store']);   //Создание нового тура  *

Route::put('/tour/update/{id}',[TourController::class, 'update']);   //Изменение тура   *

Route::delete('/tour/delete/{id}',[TourController::class, 'destroy']);   //Удаление тура  *

Route::get('/search',[TourController::class, 'search']);  //Поиск по названию тура (в форме передовать id= 'query' );  *

Route::get('/filter',[TourController::class, 'filter']);  //Фильтрация в форме передовать date_start status prise  *



//Region

Route::get('/region',[RegionController::class, 'index']);//Вывод всех городов   *

Route::get('/region/{id}',[RegionController::class, 'show']);//вывод города

Route::post('/region/create',[RegionController::class, 'store']);  //Создание нового города

Route::delete('/region/delete/{id}',[RegionController::class, 'destroy']);   //Удаление города  *

//Guide

Route::get('/guide',[GuideController::class, 'index']);  //Просмотр всех гидов  *

Route::post('/guide/create',[GuideController::class, 'store']);  //Создание нового гида  *

Route::get('/guide/{id}',[GuideController::class, 'show']); //Вывод данного гида *

Route::put('/guide/update/{id}',[GuideController::class, 'update']);  //Изиенение данных гида

Route::delete('/guide/delete/{id}',[GuideController::class, 'destroy']);  //Удаление гида  *

//Feedback

Route::post('/feedback/create',[FeedbackController::class, 'store']);  //Создание нового комментария


//Booked_tours


Route::get('/booked',[BookedTourController::class, 'index']);  //Отображение заказанных туров

Route::post('/booked/create',[BookedTourController::class, 'show']);  //Создание заказа

Route::put('/booked/update/{id}',[BookedTourController::class, 'update']);  //Ихменение данных заказа


//Housing

Route::post('/housing/photo',[HousingTourController::class, 'store']);  //Создание отеля *

Route::get('/housing',[HousingTourController::class, 'index']); //Вывод всех отелей *

Route::get('/housing/{id}',[HousingTourController::class, 'show']); //Вывод одного отеля  *

Route::delete('/housing/delete/{id}',[HousingTourController::class, 'destroy']);   //Удаление отеля  *

Route::group(['middleware'=>['auth:sanctum']],function (){

});

<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EmailController;
use App\Http\Controllers\API\HousingTourController;
use App\Http\Controllers\API\NewPasswordController;
use App\Http\Controllers\API\ProgrammTourController;
use App\Http\Controllers\API\TourController;
use App\Http\Controllers\API\RegionController;
use App\Http\Controllers\API\GuideController;
use App\Http\Controllers\API\FeedbackController;
use App\Http\Controllers\API\BookedTourController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VerifyEmailController;

use App\Http\Controllers\API\PasswordController;
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


//Auth
Route::post('/register',[AuthController::class, 'register'])->name('register');

Route::post('/login',[AuthController::class, 'login']);



//Tour
Route::get('/tours',[TourController::class, 'index'])->name('index'); //Вывод всех туров  *

Route::get('/tour/{id}',[TourController::class, 'show']); //Вывод одного тура *

Route::get('/tours/search',[TourController::class, 'search']);  //Поиск по названию тура (в форме передовать id= 'query' );  *

Route::get('/tours/filter',[TourController::class, 'filter']);  //Фильтрация в форме передовать date_start status prise  *



//Region

Route::get('/region',[RegionController::class, 'index']);//Вывод всех городов   *

Route::get('/region/{id}',[RegionController::class, 'show']);//вывод города





//Guide

Route::get('/guide',[GuideController::class, 'index']);  //Просмотр всех гидов  *

//Housing

Route::get('/housing/{id}',[HousingTourController::class, 'show']); //Вывод одного отеля  *







//Функции пользователя

Route::middleware(['auth:sanctum', 'id_role:2'])->group(function () {

    //Password

    Route::post('/reset-password', [PasswordController::class, 'store'])->middleware(['guest']);  //Отправка сообщений на почту

    Route::post('/password-recovery', [NewPasswordController::class, 'store'])->middleware(['guest'])->name('password.reset');  //Смена пароля



    //email

    Route::post('/email',[EmailController::class, 'store']);  //Подтверждение почты *

    Route::get('/verify_email/{id}/{hash}',VerifyEmailController::class)->middleware(['signed'])->name('verification.verify');  //Подтверждение почты из сообщения *


    //Booked_tours

    Route::post('/booked/create',[BookedTourController::class, 'store']);  //Создание заказа  *

    Route::get('/booked/user',[BookedTourController::class, 'index_user']);  //Отображение заказанных туров  *

    Route::delete('/booked/delete/{id}',[BookedTourController::class, 'destroy']);   //Отказ от заявки  *

    //Feedback

    Route::post('/feedback/create',[FeedbackController::class, 'store']);  //Создание нового комментария

    //User

    Route::put('/user/update/{id}',[UserController::class, 'update']);  //Изиенение данных пользователя

    Route::get('/user/{id}',[UserController::class, 'show']); //Вывод данных текущего пользователя

    //Logout
    Route::delete('/user/logout',[AuthController::class, 'logout']);  //Удаление токена Текущего пользователя
});



//Функционал администратора

Route::middleware(['auth:sanctum', 'id_role:1'])->group(function () {

    //Password

    Route::post('/password', [PasswordController::class, 'store'])->middleware(['guest']);  //Отправка сообщений

    Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware(['guest'])->name('password.reset');  //Смена пароля



    //email

    Route::post('/email',[EmailController::class, 'store']);  //Подтверждение почты *

    Route::get('/verify_email/{id}/{hash}',VerifyEmailController::class)->middleware(['signed'])->name('verification.verify');  //Подтверждение почты из сообщения *


    //Region

    Route::delete('/region/delete/{id}',[RegionController::class, 'destroy']);   //Удаление города  *

    Route::post('/region/create',[RegionController::class, 'store']);  //Создание нового города

    //Housing

    Route::post('/housing/photo',[HousingTourController::class, 'store']);  //Создание отеля *

    Route::get('/housing',[HousingTourController::class, 'index']); //Вывод всех отелей *

    Route::delete('/housing/delete/{id}',[HousingTourController::class, 'destroy']);   //Удаление отеля  *


    //Guide

    Route::post('/guide/create',[GuideController::class, 'store']);  //Создание нового гида  *

    Route::put('/guide/update/{id}',[GuideController::class, 'update']);  //Изиенение данных гида

    Route::delete('/guide/delete/{id}',[GuideController::class, 'destroy']);  //Удаление гида  *

    Route::get('/guide/{id}',[GuideController::class, 'show']); //Поках гида


    //Tour

    Route::post('/tour/create',[TourController::class, 'store']);   //Создание нового тура  *

    Route::put('/tour/update/{id}',[TourController::class, 'update']);   //Изменение тура   *

    Route::delete('/tour/delete/{id}',[TourController::class, 'destroy']);   //Удаление тура  *


    //Booked_tours

    Route::get('/booked',[BookedTourController::class, 'index']);  //Отображение заказанных туров  *

    Route::get('/booked/{id}',[BookedTourController::class, 'show']); //Вывод одной заявки  *

    Route::put('/booked/update/{id}',[BookedTourController::class, 'update']);  //Изменение статуса заказа  *


    //User

    Route::delete('/user/token_delete/',[UserController::class, 'destroy']);  //Удаление токена Текущего пользователя

    //Logout
    Route::delete('/user/logout',[AuthController::class, 'logout']);  //Удаление токена Текущего пользователя

    //Program
    Route::post('/program/create',[ProgrammTourController::class, 'store']);  //Создание программы тура

});

<?php

use App\Http\Controllers\API\EmailController;
use App\Http\Controllers\API\VerifyEmailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'id_role:1'])->group(function (){
    Route::post('/email', [EmailController::class, 'store']);  //Подтверждение почты *

    Route::get('/verify_email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed'])->name('verification.verify');
});

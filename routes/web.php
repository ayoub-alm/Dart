<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DartController;
use App\Models\Participnt;

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

Route::get('/', function () {
    //         vider le tableux 
    Participnt::truncate();
    return view('welcome');
});


Route::post('dartCreat', [DartController::class ,'creat'])->name('dart.creat');
Route::post('addPerson', [DartController::class ,'addPersons'])->name('dart.add');
Route::post('showRuselts', [DartController::class ,'showRuselt'])->name('dart.Ruselts');
Route::post('showMounthDetials', [DartController::class ,'showMounthDetial'])->name('dartshowMounthDetials');





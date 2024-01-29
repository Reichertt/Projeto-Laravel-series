<?php

use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeasonsController; 
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/series');
});

Route::resource('/series', SeriesController::class)
->except(['show']);

Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index');

// Route::post('/series/destroy/{serie}', [SeriesController::class, 'destroy'])
// ->name('series.destroy');

// Agrupador de rotas
// route::controller(SeriesController::class)->group(function() {

//     Route::get('/series', 'index')->name('series.index'); 
//     Route::get('/series/create', 'create')->name('series.create');
//     Route::post('/series/salvar', 'store')->name('series-store');
// });
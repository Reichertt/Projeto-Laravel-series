<?php

use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeasonsController; 
use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Autenticador;
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

Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])
    ->name('seasons.index')
    ->middleware(Autenticador::class);

// Rota referente aos ep de cada temporada
Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index'])->name('episodes.index');

// Envia os episodios marcados para o BD e redireciona para a mesma página
Route::post('/seasons/{season}/episodes', [EpisodesController::class, 'update'])->name('episodes.update');

// Direciona o cliente para a rota de login
route::get('/login', [LoginController::class, 'index'])->name('login');

// Realiza o login
route::post('/login', [LoginController::class, 'store'])->name('signin');

route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

// Direciona o usuário para a rota de cadastro de usuario
route::get('/register', [UsersController::class, 'create'])->name('users.create');

// Posta um novo usuário no BD
route::post('/register', [UsersController::class, 'store'])->name('users.store');

// Route::post('/series/destroy/{serie}', [SeriesController::class, 'destroy'])
// ->name('series.destroy');

// Agrupador de rotas
// route::controller(SeriesController::class)->group(function() {

//     Route::get('/series', 'index')->name('series.index'); 
//     Route::get('/series/create', 'create')->name('series.create');
//     Route::post('/series/salvar', 'store')->name('series-store');
// });
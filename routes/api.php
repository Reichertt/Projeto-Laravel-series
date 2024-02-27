<?php

use App\Http\Controllers\Api\SeriesController;
use App\Models\Episode;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Verificando a rota aqui e no arquivo de routes WEB temos 
// o msm /series mas não a quebra de rotas pois quando uma rota 
// é adicionada no arquivo de routes Api ele já fica iniciamente 
// com a URL tendo /api ficando entaço como exemplo "/api/series/"

 // Rota que direciona para o controller para efetuar as função da API
 Route::apiResource('/series', SeriesController::class);

 // Trás todos as temporadas de uma série 
 Route::get('/series/{series}/seasons', function (Series $series) {
    return $series->seasons;
 });

 // Acessa os episodios de uma série
 Route::get('/series/{series}/episodes', function(Series $series) {
    return $series->episodes;
 });

 // Serve para a API enviar a um episódio como assistido
 Route::patch('/episodes/{episode}', function (Episode $episode, Request $request) {
    $episode->watched = $request->watched;
    $episode->save();

    return $episode;
 });
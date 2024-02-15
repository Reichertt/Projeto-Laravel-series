<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodesController 
{
    public function index(Season $season)
    {
        // Retorna os episodios daquela determinada temporada
        return view('episodes.index', [
            'episodes' => $season->episodes,
            'mensagemSucesso' => session('mensagem.sucesso')
        ]);
    }

    public function update(Request $request, Season $season)
    {
        $watchedEpisodes = $request->episodes;

        // Para cada um dos episodios da temporada a função será executada, utilizando o método each e marcará 
        $season->episodes->each(function (Episode $episode) use ($watchedEpisodes) {
            $episode->watched = in_array($episode->id, $watchedEpisodes);
        });

        $season->push();

        // Logo após efetuar o UPDATE, o usuário é redirecionado para o ínicio
        return to_route('episodes.index', $season->id)
        ->with('mensagem.sucesso', 'Episódios marcados como assistidos');
    }
} 
<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use Illuminate\Http\Request;
use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;

class SeriesController extends Controller
{
    // Trás todas as series do BD
    public function index(Request $request)
    {
        $series = Series::all();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);
        // return view('listar-series', compact('series'));
    }

    public function create() 
    {
        return view('series.create');
    }

    // Salva os dados no BD
    public function store(SeriesFormRequest $request)
    {
        $serie = Series::create($request->all());
        $seasons = [];

        for ($i = 1; $i <= $request->seasonsQty; $i++) {
            $seasons[] = [
                'series_id' => $serie->id,
                'number' => $i
            ];
        }
        Season::insert($seasons);

        $episodes = [];
        foreach ($serie->seasons as $season) {
            for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                $episodes[] = [
                    'season_id' => $season->id,
                    'number'    => $j 
                ];
            }
        }
        Episode::insert($episodes);

        // Caso a requicisão tenha o status de sucesso, mostra a mensagem
        return to_route('series.index')->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
    }

    // remove os dados no BD
    public function destroy(Series $series)
    {
        $series->delete();

        // Caso a requicisão tenha o status de sucesso, mostra a mensagem
        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso");
    }

    // Trás na área de edição a série passada por ID
    public function edit(Series $series)
    {
        return view('series.edit')->with('serie', $series);
    }

    // Realiza o update na série que está sendo editada
    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' atualizado com sucesso");
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository)
    {
    }

    public function index(Request $request)
    {
        $query = Series::query();

        if($request->has('nome')) {
          $query->where('nome', $request->nome);
        }

        return $query->paginate(5);
    }

    // função relacionada a criação de serie atraves de API
    public function store(SeriesFormRequest $request)
    {
        return response()
            ->json($this->seriesRepository->add($request), 201);
    }

    // Retorna a série em especifico que a API requisitou
    public function show(int $series)
    {
        $seriesModel = Series::with('seasons.episodes')->find($series);

        // Se a série buscada pela requisição da API não existir, retorna a mensagem com 404
        if ($seriesModel === null)
        {
            return response()->json(['message' => 'Série não encontrado'], 404);
        }

        return $seriesModel;
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return $series;
    }

    public function destroy(int $series)
    {
         Series::destroy($series);
         return response()->noContent();
    }
}

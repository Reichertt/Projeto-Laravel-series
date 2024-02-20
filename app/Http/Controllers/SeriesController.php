<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Mail\SeriesCreated;
use Illuminate\Http\Request;
use App\Models\Series;
use App\Models\User;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\Mail;

class SeriesController extends Controller
{
    // Método utilizando inversão de dependência 
    public function __construct(private SeriesRepository $repository)
    {
        $this->middleware(Autenticador::class)->except('index');
    }

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
        $serie = $this->repository->add($request);

        $userList = User::all();

        foreach ($userList as $index => $user) {

        // Envia um determinado e-mail quando uma nova série é criada
        $email = new SeriesCreated(
            $serie->nome,
            $serie->id,
            // Informações recebidas da requisição
            $request->seasonsQty,
            $request->episodesPerSeason,
        );

            // Pega o indice, utiliza o método para adicionar 10 segundos de envio por E-mail aos usuários
            $when = now()->addSeconds( $index * 10);
            // Adiciona os E-mails a uma fila
            Mail::to($user)->later($when, $email);
        }

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

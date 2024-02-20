@component('mail::message')
    
    # {{ $nomeSerie }} Criada

    A série {{ $nomeSerie }} com {{ $qtdTemporadas }} temporadas e {{ $episodiosPorTemporada }} episódios por temporada foi criada.

    Acesse aqui: 

    <!-- Direciona o usuário do e-mail para a rota escolhida quando o msm clica no botão -->
    @component('mail::button', ['url' => route('seasons.index', $idSerie)])
        Ver série
    @endcomponent

@endcomponent
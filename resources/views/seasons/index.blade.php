<x-layout title="Temporadas de {!! $series->nome !!}">

    <ul class="list-group">
        @foreach ($seasons as $season)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('episodes.index', $season->id) }}">
               Temporada {{$season->number}}
            </a>

            <span class="badge bg-secondary">
                <!-- Realiza a contagem de episódios marcados como assistidos -->
                {{ $season->numberOfWatchedEpisodes() }} / {{ $season->episodes->count() }}
            </span>
        </li>
        @endforeach
    </ul>

    <!-- Dessa maneira a baixo utilizando o @ o blade ignora a maneira de pesquisa e entende que você deseja realmente mostrar o que está ali. -->
    <!-- @{{ nome}} -->
</x-layout>
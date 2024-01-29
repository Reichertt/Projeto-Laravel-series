<x-layout title="Temporadas de {!! $series->nome !!}">

    <ul class="list-group">
        @foreach ($seasons as $season)
        <li class="list-group-item d-flex justify-content-between align-items-center">
               Temporada {{$season->number}}

            <span class="badge bg-secondary">
                {{ $season->episodes->count() }}
            </span>
        </li>
        @endforeach
    </ul>

    <!-- Dessa maneira a baixo utilizando o @ o blade ignora a maneira de pesquisa e entende que você deseja realmente mostrar o que está ali. -->
    <!-- @{{ nome}} -->
</x-layout>
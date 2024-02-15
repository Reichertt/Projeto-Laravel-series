<x-layout title="Episódios" :mensagem-sucesso="$mensagemSucesso">
<form method="post">
    @csrf
    <ul class="list-group">
        @foreach ($episodes as $episode)
        <li class="list-group-item d-flex justify-content-between align-items-center">
               Episódio {{$episode->number}}
    
            <input 
            type="checkbox" 
            name="episodes[]" 
            value="{{ $episode->id }}"
            @if ($episode->watched) checked @endif />
            
        </li>
        @endforeach
    </ul>
<div style="text-align: right">
    <button class="btn btn-primary mt-2 mb-2">Salvar</button>
</div>
</form>
    <!-- Dessa maneira a baixo utilizando o @ o blade ignora a maneira de pesquisa e entende que você deseja realmente mostrar o que está ali. -->
    <!-- @{{ nome}} -->
</x-layout>
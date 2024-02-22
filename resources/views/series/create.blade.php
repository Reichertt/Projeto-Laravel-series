 <x-layout title="Nova Série">
    <!-- Maneira que o blade lida com as rotas de redirecionamento e envio {{Route ('series.store')}}-->
<form action="{{ route('series.store') }}" method="post" enctype="multipart/form-data">
    <!-- @csrf faz a verificação obrigatoria que o laravel pede, que verifica se o formulario realmente está sendo enviado do próprio site.-->
    @csrf

    <div class="row mb-3">
        <div class="col-8">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text"
                autofocus
                   id="nome"
                   name="nome"
                   class="form-control"
                   value="{{old ('nome') }}">
        </div>

    <div class="col-2">
        <label for="seasonsQty" class="form-label">Temporadas</label>
        <input type="text"
                id="seasonsQty"
                name="seasonsQty"
                class="form-control"
                value="{{ old('seasonsQty')}}">
    </div>
    <div class="col-2">
        <label for="episodesPerSeason" class="form-label">Eps / Temporada:</label>
        <input type="text"
                id="episodesPerSeason"
                name="episodesPerSeason"
                class="form-control"
                value="{{ old('episodesPerSeason')}}">
    </div>
</div>

    <div class="row mb-3">
        <div class="col-12">
            <label for="cover" class="form-label">Capa</label>
            <input 
                type="file" 
                name="cover" 
                id="cover" 
                class="form-control"
                accept="image/png, image/gif, image/jpeg">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Adicionar</button>
</form>
</x-layout> 

<!-- O "old" método guarda as infromações enviadas da ultima requisição -->
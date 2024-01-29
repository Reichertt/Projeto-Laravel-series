<!-- Maneira que o blade lida com as rotas de redirecionamento e envio {{Route ('series.store')}}-->
<form action="{{ $action }}" method="post">
    <!-- @csrf faz a verificação obrigatoria que o laravel pede, que verifica se o formulario realmente está sendo enviado do próprio site.-->
    @csrf

    <!-- Se o nome está definido, será uma atualização e o metódo enviado será o PUT-->
    @if($update)
    @method('PUT')
    @endif
    <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" id="nome" name="nome" class="form-control" 
        @isset($nome)value="{{$nome}}"@endisset>
    </div>
    <button type="submit" class="btn btn-primary">Adicionar</button>
</form>
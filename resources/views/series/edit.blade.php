<x-layout title="Editar Série '{!! $serie->nome !!}' ">
    <x-form :action="route('series.update', $serie->id)" :nome="$serie->nome" :update="true"/>
</x-layout> 
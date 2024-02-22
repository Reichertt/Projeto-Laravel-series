<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\SeriesCreated as SeriesCreatedEvent;
use App\Mail\SeriesCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

// Clase respnsável por executar um evento quando chamado
class EmailUserAboutSeriesCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(SeriesCreatedEvent $event)
    {
        $userList = User::all();

        foreach ($userList as $index => $user) {

        // Envia um determinado e-mail quando uma nova série é criada
        $email = new SeriesCreated(
            $event->SeriesName,
            $event->SeriesId,
            // Informações recebidas da requisição
            $event->SeriesSeasonsQty,
            $event->SeriesEpisodesPerSeason,
        );

            // Pega o indice, utiliza o método para adicionar 10 segundos de envio por E-mail aos usuários
            $when = now()->addSeconds( $index * 10);
            // Adiciona os E-mails a uma fila
            Mail::to($user)->later($when, $email);
        }
    }
}

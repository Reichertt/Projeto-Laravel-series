<?php

namespace App\Providers;

use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Support\ServiceProvider;

class SeriesRepositoryProvider extends ServiceProvider
{
    // Essa fumção realiza a mesma coisa que a de baixo
    public array $bindings = [
        SeriesRepository::class => EloquentSeriesRepository::class
    ];

    /**
     * Register services.
     */
    // public function register(): void
    // {
    //     // Ensina como instanciar o repósitorio de series
    //     $this->app->bind( SeriesRepository::class, EloquentSeriesRepository::class);
    // }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cover'];
    protected $appends = ['links'];

    public function seasons()
    {
        // "hasMany" Defini um relacionamento de um para muitos, 1 serie tem muitas temporadas
        return $this->hasMany(Season::class, 'series_id');
    }

    public function episodes()
    {
        // O relacionamento “hasManyThrough” fornece uma maneira conveniente de acessar relações distantes por meio de uma relação intermediária./
        return $this->hasManyThrough(Episode::class, Season::class);
    }

    public static function booted()
    {
        self::addGlobalScope( 'ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('nome', 'asc');
        });
    }

    public function links(): Attribute
    {
        return new Attribute(
            get: fn () => [
                [
                    'rel' => 'self',
                    'url' => "/api/series/{$this->id}"
                ],
                [
                    'rel' => 'seasons',
                    'url' => "/api/series/{$this->id}/seasons"
                ],
                [
                    'rel' => 'episodes',
                    'url' => "/api/series/{$this->id}/episodes"
                ],
            ],
        );
    }
}
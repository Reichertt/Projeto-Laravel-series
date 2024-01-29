<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public function seasons()
    {
        // "hasMany" Defini um relacionamento de um para muitos, 1 serie tem muitas temporadas
        return $this->hasMany(Season::class, 'series_id');
    }

    public static function booted()
    {
        self::addGlobalScope( 'ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('nome', 'asc');
        });
    }
}
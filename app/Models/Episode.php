<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    // Indica para o BD que não será informado o timestamps
    public $timestamps = false;
    protected $fillable = ['number'];
    public function season()
    {
        // "belongsTo" Cria o relacionamento de episode e as season
        return $this->belongsTo(Season::class);
    }
}
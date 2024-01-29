<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    protected $fillable = ['number'];

    public function series()
    {
        // "belongsTo" Cria o relacionamento de Season e a series
        return $this->belongsTo(Series::class);
    }

    public function episodes() 
    {
        // "hasMany" Defini um relacionamento de um para muitos
        return $this->hasMany(Episode::class);   
    }
}
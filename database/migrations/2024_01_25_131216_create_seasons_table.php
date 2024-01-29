<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();

            // "unsignedTinyInteger" é um tipo de dado que armazena números inteiros pequenos e não negativos.
            $table->unsignedTinyInteger('number');

            // Automaticamente configura a chave estrangeira para a coluna series_id referenciar a coluna id na tabela associada e deletar os associados.
            $table->foreignId('series_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('seasons');
    }
};

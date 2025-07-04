<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotisationsTable extends Migration
{
    public function up()
    {Schema::create('cotisations', function (Blueprint $table) {
    $table->id();
    $table->string('nom');
    $table->integer('nombre_participants');
    $table->decimal('montant', 10, 2);
    $table->enum('statut', ['Mensuelle', 'Annuelle', 'Événementielle']);
    $table->date('date_debut');
    $table->date('date_fin');
    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('cotisations');
    }
}

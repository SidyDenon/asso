<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementsTable extends Migration
{
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membre_id')->constrained('membres')->onDelete('cascade');
            $table->foreignId('cotisation_id')->constrained('cotisations')->onDelete('cascade');
            $table->decimal('montant_paye', 10, 2);
            $table->date('date_paiement');
            $table->string('mode_paiement');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paiements');
    }
}


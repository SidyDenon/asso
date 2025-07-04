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
    Schema::create('inscriptions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('membre_id');
        $table->unsignedBigInteger('evenement_id');
        $table->timestamps();

        $table->foreign('membre_id')->references('id')->on('membres')->onDelete('cascade');
        $table->foreign('evenement_id')->references('id')->on('evenements')->onDelete('cascade');
        $table->unique(['membre_id', 'evenement_id']);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};

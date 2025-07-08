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
    Schema::create('adhesions', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('cin');
        $table->string('photo');
        $table->string('card');
        $table->string('phone');
        $table->string('password');
        $table->string('email');
        $table->string('country');
        $table->string('city');
        $table->string('education');
        $table->string('job');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adhesions');
    }
};

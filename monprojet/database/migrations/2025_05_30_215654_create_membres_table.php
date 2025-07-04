<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembresTable extends Migration
{
    public function up()
    {Schema::create('membres', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('cin')->unique();
    $table->string('email')->unique();
    $table->string('phone');
    $table->string('password');
    $table->string('country')->nullable();
    $table->string('city')->nullable();
    $table->string('education')->nullable();
    $table->string('profession')->nullable();
    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('membres');
    }
}

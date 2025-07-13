<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use Illuminate\Support\Facades\Artisan;

Route::get('/migrate', function () {
    Artisan::call('migrate', ["--force" => true]);
    return "✅ Migrations exécutées avec succès !";
});

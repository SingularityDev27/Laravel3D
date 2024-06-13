<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('Login');
});

Route::get('/inicio',[ViewsController::class,'inicioView']);
Route::get('/contacto',[ViewsController::class,'contactView']);

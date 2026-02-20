<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Layout.welcome');
});

// Rotas para as páginas de cálculos
Route::view('/medidaw-reto', 'pages.medidaw-reto')->name('medidaw.reto');
Route::view('/medidaw-helicoidal', 'pages.medidaw-helicoidal')->name('medidaw.helicoidal');
Route::view('/helicoidal', 'pages.helicoidal')->name('helicoidal');
Route::view('/kit-com-passo', 'pages.kit-com-passo')->name('kit.com-passo');
Route::view('/medida-cordal', 'pages.medida-cordal')->name('medida.cordal');

// Rotas para páginas institucionais
Route::view('/pagamentos', 'pages.pagamentos')->name('pagamentos');
Route::view('/sobre', 'pages.sobre')->name('sobre');

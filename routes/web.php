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
Route::view('/medida-cordal', 'pages.em-progresso-1')->name('medida.cordal');

// Rotas para páginas institucionais
Route::view('/engrenagens', 'pages.engrenagens')->name('engrenagens');
Route::view('/pagamentos', 'pages.pagamentos')->name('pagamentos');
Route::view('/sobre', 'pages.sobre')->name('sobre');
Route::view('/em-progresso-2', 'pages.em-progresso-2')->name('em-progresso-2');

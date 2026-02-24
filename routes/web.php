<?php

use Illuminate\Http\Request;
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
Route::post('/engrenagens', function (Request $request) {
    $configuracao = $request->input('configuracao');

    if ($configuracao === 'minmax') {
        $validated = $request->validate([
            'configuracao' => ['required', 'in:minmax,selecionada'],
            'engrenagem_min' => ['required', 'integer', 'min:18', 'max:127'],
            'engrenagem_max' => ['required', 'integer', 'min:18', 'max:127', 'gte:engrenagem_min'],
        ]);

        $engrenagens = range((int) $validated['engrenagem_min'], (int) $validated['engrenagem_max']);
    } else {
        $validated = $request->validate([
            'configuracao' => ['required', 'in:minmax,selecionada'],
            'engrenagens' => ['required', 'array', 'min:1'],
            'engrenagens.*' => ['integer', 'min:18', 'max:127'],
        ]);

        $engrenagens = array_values(array_unique(array_map('intval', $validated['engrenagens'])));
        sort($engrenagens);
    }

    session([
        'engrenagens_configuracao' => $configuracao,
        'engrenagens_min' => $request->input('engrenagem_min'),
        'engrenagens_max' => $request->input('engrenagem_max'),
        'engrenagens_selecionadas' => $engrenagens,
    ]);

    return redirect()->route('engrenagens')->with('status', 'Configuração salva com sucesso.');
})->name('engrenagens.save');
Route::view('/pagamentos', 'pages.pagamentos')->name('pagamentos');
Route::view('/sobre', 'pages.sobre')->name('sobre');
Route::view('/em-progresso-2', 'pages.em-progresso-2')->name('em-progresso-2');

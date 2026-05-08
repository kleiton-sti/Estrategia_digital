<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EixoController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\PlanoDiretorController;
use App\Http\Controllers\AcoesInovacaoController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\RegulamentacoesController;

Route::get('/', [EixoController::class, 'index'])->name('home');

Route::get('/eixos/{id}', [EixoController::class, 'show'])->name('eixos.show');

Route::get('/tabelas', [AcoesInovacaoController::class, 'index'])->name('tabelas');

Route::get('/roadmap', [RoadmapController::class, 'index'])->name('roadmap');

Route::get('/plano', [PlanoDiretorController::class, 'plano'])->name('plano');

Route::get('/regulamentacoes', [RegulamentacoesController::class, 'index'])->name('regulamentacoes');

Route::get('/produtos/stii-em-numeros', [ProdutosController::class, 'numeros'])->name('produtos.stii.numeros');

Route::get('/produtos/all-hands', [ProdutosController::class, 'allHands'])->name('produtos.all.hands');

// Route::view('/artigos', 'produtos.artigos')->name('produtos.artigos');

Route::get('/artigos', function() {
    $artigos = \App\Models\Artigo::with('categoria')->get();
    return view('produtos.artigos', compact('artigos'));
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EixoController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\PlanoDiretorController;
use App\Http\Controllers\AcoesInovacaoController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\RegulamentacoesController;
use App\Http\Controllers\AutenticacaoController;
use App\Http\Controllers\PublicacaoController;
use App\Http\Controllers\UploadController;

/* Rotas públicas */
Route::get('/', [EixoController::class, 'index'])->name('home');

/* Redirects 301 — URLs antigas indexadas pelo Google */
Route::redirect('/public/tabelas',              '/indicadores',      301);
Route::redirect('/public/plano',                '/plano-diretor-ti', 301);
Route::redirect('/public/roadmap',              '/roadmap',          301);
Route::redirect('/public/produtos/all-hands',   '/produtos/all-hands', 301);
Route::redirect('/public/regulamentacoes',      '/regulamentacoes',  301);
Route::redirect('/public/artigos',              '/artigos',          301);
Route::redirect('/tabelas',                     '/indicadores',      301);

/* 410 Gone — recursos removidos permanentemente */
Route::get('/public/eixos/{id}', fn() => abort(410));
Route::get('/eixos/{id}',        fn() => abort(410));


// Route::get('/eixos/{id}', [EixoController::class, 'show'])->name('eixos.show');
Route::get('/indicadores', [AcoesInovacaoController::class, 'index'])->name('tabelas');
Route::get('/roadmap', [RoadmapController::class, 'index'])->name('roadmap');
Route::get('/plano-diretor-ti', [PlanoDiretorController::class, 'plano'])->name('plano');
Route::get('/regulamentacoes', [RegulamentacoesController::class, 'index'])->name('regulamentacoes');
Route::get('/produtos/stii-em-numeros', [ProdutosController::class, 'numeros'])->name('produtos.stii.numeros');
Route::get('/produtos/all-hands', [ProdutosController::class, 'allHands'])->name('produtos.all.hands');
Route::get('/artigos', [ProdutosController::class, 'artigos'])->name('artigos');
Route::get('/artigos/{slug}', [ProdutosController::class, 'conteudoArtigo'])->name('artigos.conteudo');

/* Autenticação — acesso restrito à subrede 192.168.11.x */
Route::middleware('rede.stii')->group(function () {
    Route::get('/entrar', [AutenticacaoController::class, 'exibirLogin'])->name('login');
    Route::post('/entrar', [AutenticacaoController::class, 'autenticar'])->name('autenticar');
});

Route::post('/sair', [AutenticacaoController::class, 'sair'])->name('sair')->middleware('auth');

/* Área autenticada */
Route::middleware('auth')->group(function () {
    Route::get('/painel/artigos', [PublicacaoController::class, 'painel'])->name('artigos.painel');
    Route::get('/painel/publicar', [PublicacaoController::class, 'criar'])->name('artigos.criar');
    Route::post('/painel/publicar', [PublicacaoController::class, 'salvar'])->name('artigos.salvar');
    Route::get('/painel/artigos/{slug}/editar/{id}', [PublicacaoController::class, 'editar'])->name('artigos.editar');
    Route::put('/painel/artigos/{slug}/{id}', [PublicacaoController::class, 'atualizar'])->name('artigos.atualizar');
    Route::delete('/painel/artigos/{slug}/{id}', [PublicacaoController::class, 'excluir'])->name('artigos.excluir');
    Route::post('/painel/upload/imagem', [UploadController::class, 'imagem'])->name('upload.imagem');
});

/* link para sitemap */

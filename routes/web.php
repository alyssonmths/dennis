<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\GraficoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\PdfController;
use Illuminate\Http\Request;

Route::get('/', [DashboardController::class, 'index'])->name('index');

Route::prefix('calculos')->group(function () {
    Route::get('novo', [CalculoController::class, 'list'])->name('calculos.novo');
    Route::post('registrarCarrinho', [CalculoController::class, 'registrarCarrinho']); // registra o item no carrinho
    Route::post('atualizar', [CalculoController::class, 'atualizar']); // atualiza a quantidade do item
    Route::get('listar/{id?}', [CalculoController::class, 'listar'])->name('calculos.listar'); // lista os cálculos
    Route::post('registrar', [CalculoController::class, 'registrar'])->name('calculo.registrar');
    Route::get('funcionario/{id}', [CalculoController::class, 'calculosFuncionario'])->name('calculos.funcionario');
});

Route::get('/precos/{filtro?}', [ItemController::class, 'list'])->name('item.precos'); // lista os preços dos itens

Route::group([
    'prefix' => 'item', 'as' => 'item.'
], function () {
    Route::post('registrar', [ItemController::class, 'registrar'])->name('registrar');
    Route::post('apagar', [ItemController::class, 'apagar']);
    Route::get('editar/{id}', [ItemController::class, 'editar'])->name('editar');
    Route::post('update', [ItemController:: class, 'update'])->name('update');
});

Route::get('/estatisticas', [GraficoController::class, 'index'])->name('estatisticas');

Route::post('/dados/{parametro?}/{id?}', [GraficoController::class, 'retornarDados']);

Route::get('/funcionarios', [FuncionarioController::class, 'list'])->name('funcionarios'); // lista os funcionários

Route::group([
    'prefix' => 'funcionario',
    'as' => 'funcionario.'
], function () {
    Route::post('registrar', [FuncionarioController::class, 'registrar'])->name('registrar'); // registro de novo funcionário
    Route::post('atualizar', [FuncionarioController::class, 'atualizar'])->name('atualizar'); // atualiza o funcionário
    Route::post('retornar', [FuncionarioController::class, 'retornarFuncionario']); // retorna os dados de um funcionário para a edição
    Route::get('apagar/{id}', [FuncionarioController::class, 'apagar'])->name('apagar'); // apaga o funcionário
});

Route::get('/gerarPDF/{parametro}', [PdfController::class, 'gerarPdf'])->name('gerar.pdf');
<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\LojasController;
use App\Http\Controllers\OfertasController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ReceberofertasController;
use App\Http\Controllers\SubcategoriasController;
use App\Http\Controllers\ViewpublicaController;
use App\Http\Controllers\ContatosController;
use App\Http\Controllers\AvisosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
;

 Auth::routes();

 Route::middleware(['auth'])->group(function () {
    Route::get('/loja', [LojasController::class, 'listar']);
    Route::get('/loja/create', [LojasController::class, 'create'])->name('loja.create');
    Route::get('/loja/report',[LojasController::class, 'showReport']);
    Route::get('/subcategoria/report',[SubcategoriasController::class, 'showReport']);
    Route::get('/produto/report',[ProdutosController::class, 'showReport']);
    Route::get('/loja/{loja_id}',[LojasController::class, 'show'])->name('loja.show');
    Route::post('/loja', [LojasController::class, 'store']);
    Route::patch('/loja/{loja_id}', [LojasController::class, 'update']);
    Route::delete('/loja/{loja_id}', [LojasController::class, 'deletar']);
    Route::resource('categoria', CategoriasController::class);
    Route::resource('produto', ProdutosController::class);
    Route::resource('receberoferta',ReceberofertasController::class);
    Route::resource('subcategorias',SubcategoriasController::class);
    Route::resource('ofertas',OfertasController::class);
    Route::get('contatos',[ContatosController::class,'index']);
    Route::post('contatos',[ContatosController::class, 'enviar']);

});
Route::resource('verofertas',ViewpublicaController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('contatos',[ContatosController::class,'index']);
Route::post('contatos',[ContatosController::class, 'enviar']);
Route::resource('aviso',AvisosController::class);

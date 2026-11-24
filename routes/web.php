
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesquisaController;


// Homepage
Route::get('/', function () {
    return view('home');
})->name('home');

// Comics
Route::get('/comics', [ComicController::class, 'allComics'])
    ->name('comics.all');

    Route::get('/comics/adicionar', [ComicController::class, 'addComics'])
    ->middleware('auth')
    ->name('comics.add');

    Route::post('/comics/adicionar', [ComicController::class, 'storeComic'])
    ->middleware('auth')
    ->name('comics.store');

Route::get('/comics/{id}', [ComicController::class, 'allComics'])
    ->name('comics.show');

// Issues
Route::get('/issues', [IssueController::class, 'allIssues'])
    ->name('issues.all');

Route::get('/issues/{id}', [IssueController::class, 'allIssues'])
    ->name('issues.show');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

    // Pesquisa geral de comics e issues
Route::get('/pesquisa', [PesquisaController::class, 'resultados'])
    ->name('pesquisa.resultados');

     // Editar Comic
Route::get('/comics/{id}/editar', [ComicController::class, 'editComic'])
    ->middleware('auth')
    ->name('comics.edit');

Route::put('/comics/{id}', [ComicController::class, 'updateComic'])
    ->middleware('auth')
    ->name('comics.update');

// Confirmar eliminação
Route::get('/comics/{id}/eliminar', [ComicController::class, 'confirmarEliminarComic'])
    ->middleware('auth')
    ->name('comics.confirmarEliminar');

// Eliminar Comic
Route::delete('/comics/{id}', [ComicController::class, 'deleteComic'])
    ->middleware('auth')
    ->name('comics.destroy');

    // Página ReadMe First!
Route::get('/readme-first', function () {
    return view('utils.readmeFirst');
})->name('readme.first');

    // Rota fallback - Página não encontrada
Route::fallback(function () {
    return response()->view('utils.fallback', [], 404);
});


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\DashboardController;


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

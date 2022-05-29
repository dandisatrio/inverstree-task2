<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Author\ArticleController;
use App\Http\Controllers\Author\CategoryController;
use App\Http\Controllers\Author\DashboardController as AuthorDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['admin.auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::group(['prefix' => 'author', 'middleware' => ['author.auth']], function () {
    Route::get('/', [AuthorDashboardController::class, 'index'])->name('author.dashboard');

    Route::get('category', [CategoryController::class, 'index'])->name('author.category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('author.category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('author.category.store');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('author.category.edit');
    Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('author.category.update');
    Route::delete('category/destroy/{id}', [CategoryController::class, 'destroy'])->name('author.category.destroy');

    Route::get('article', [ArticleController::class, 'index'])->name('author.article.index');
    Route::get('article/create', [ArticleController::class, 'create'])->name('author.article.create');
    Route::post('article/store', [ArticleController::class, 'store'])->name('author.article.store');
    Route::get('article/edit/{id}', [ArticleController::class, 'edit'])->name('author.article.edit');
    Route::post('article/update/{id}', [ArticleController::class, 'update'])->name('author.article.update');
    Route::delete('article/destroy/{id}', [ArticleController::class, 'destroy'])->name('author.article.destroy');
});

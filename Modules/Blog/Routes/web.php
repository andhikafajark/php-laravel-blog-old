<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\BlogCategoryController;
use Modules\Blog\Http\Controllers\BlogController;

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

//Route::prefix('blog')->group(function() {
//    Route::get('/', 'BlogController@index');
//});

// Blog
Route::name('blog.')->group(function () {
    Route::get('/blog', [BlogController::class, 'index'])->name('index');
    Route::get('/blog/datatables', [BlogController::class, 'datatables'])->name('datatables');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('create');
    Route::post('/blog', [BlogController::class, 'store'])->name('store');
    Route::get('/blog/{blog}', [BlogController::class, 'edit'])->name('edit');
    Route::put('/blog/{blog}', [BlogController::class, 'update'])->name('update');
    Route::patch('/blog/{blog}', [BlogController::class, 'update'])->name('update');
    Route::delete('/blog/{blog}', [BlogController::class, 'destroy'])->name('destroy');
});

// Blog Category
Route::name('blog-category.')->group(function () {
    Route::get('/blog-category', [BlogCategoryController::class, 'index'])->name('index');
    Route::get('/blog-category/datatables', [BlogCategoryController::class, 'datatables'])->name('datatables');
    Route::get('/blog-category/create', [BlogCategoryController::class, 'create'])->name('create');
    Route::post('/blog-category', [BlogCategoryController::class, 'store'])->name('store');
    Route::get('/blog-category/{blog_category}', [BlogCategoryController::class, 'edit'])->name('edit');
    Route::put('/blog-category/{blog_category}', [BlogCategoryController::class, 'update'])->name('update');
    Route::patch('/blog-category/{blog_category}', [BlogCategoryController::class, 'update'])->name('update');
    Route::delete('/blog-category/{blog_category}', [BlogCategoryController::class, 'destroy'])->name('destroy');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendPostController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    //Admin
    Route::get('dashboard', [ProfileController::class, 'index'])->name('dashboard');
    Route::post('admin/update', [ProfileController::class, 'updateAdminAccount'])->name('admin#update');
    Route::get('admin/changePasswordPage', [ProfileController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
    Route::post('admin/changePassword', [ProfileController::class, 'changePassword'])->name('admin#passwordChange');

    //Admin List
    Route::get('admin/list',[ListController::class, 'index'])->name('admin#list');
    Route::get('admin/delete/{id}', [ListController::class, 'deleteAccount'])->name('admin#delete');
    Route::post('admin/listSearch', [ListController::class, 'adminListSearch'])->name('admin#listSearch');
    //Category
    Route::get('admin/category', [CategoryController::class, 'index'])->name('admin#category');
    Route::post('admin/createCategory', [CategoryController::class, 'createCategory'])->name('admin#createCategory');
    Route::get('admin/deleteCategory/{id}', [CategoryController::class, 'deleteCategory'])->name('admin#deleteCategory');
    Route::post('admin/CategorySearch', [CategoryController::class, 'searchCategory'])->name('admin#searchCategory');
    Route::get('admin/edit/{id}', [CategoryController::class, 'editPage'])->name('admin#editPage');
    Route::post('admin/category-update/{id}', [CategoryController::class, 'updateCategory'])->name('admin#updateCategory');
    //Post
    Route::get('post', [PostController::class, 'index'])->name('admin#post');
    Route::post('admin/create/post', [PostController::class, 'createPost'])->name('admin#createPost');
    Route::get('admin/delete/post/{id}', [PostController::class, 'deletePost'])->name('admin#deletePost');
    Route::get('admin/post/updatPage/{id}', [PostController::class, 'postUpdatePage'])->name('admin#postUpdatePage');    //TrendPost
    Route::post('admin/post/update/{id}', [PostController::class, 'updatePost'])->name('admin#updatePost');


    Route::get('trendPost', [TrendPostController::class, 'index'])->name('admin#trendPost');
    Route::get('trendPost/details/{id}', [TrendPostController::class, 'showDetails'])->name('admin#trendPostDetails');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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
    return view('layouts.app');
})->name('home');

// Categorias
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Productos
Route::get('/products', [ProductController::class, 'index'])->name('products.index'); // lista
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); // muestra el formulario crear
Route::post('/products', [ProductController::class, 'store'])->name('products.store'); // almacenar en la base de datos
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show'); // muestra los datos
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit'); // muestra el formulario edit
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update'); // actualiza en la base de datos
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy'); // elimina en la base de datos

// Usuarios
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\SignosVitalesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

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
})->name('welcome');

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/personas', [PersonasController::class, 'index'])->name('personas')->middleware('auth');
Route::post('/persona-save', [PersonasController::class, 'store'])->name('persona-save')->middleware('auth');
Route::patch('/persona-update/{id}', [PersonasController::class, 'update'])->name('persona-update')->middleware('auth');
Route::get('/signos_vitales/{id_persona}', [PersonasController::class, 'show'])->name('signos_vitales')->middleware('auth');

Route::delete('/signos_vitales/{id}', [SignosVitalesController::class, 'destroy'])->name('signos_vitales')->middleware('auth');
Route::post('/signos-save', [SignosVitalesController::class, 'store'])->name('signos-save')->middleware('auth');

Route::get('/usuarios', [UsersController::class, 'index'])->name('usuarios')->middleware('auth');
Route::post('/usuario-save', [UsersController::class, 'store'])->name('usuario-save')->middleware('auth');
Route::patch('/usuario-update/{id}', [UsersController::class, 'update'])->name('usuario-update')->middleware('auth');

<?php

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

Route::get('/', \App\Livewire\Dashboard::class);
Route::get('/strategy/{id}', App\Livewire\StrategyDetail::class)->name("detail");

Route::get('/accounts/{id}', \App\Livewire\AccountDetail::class);

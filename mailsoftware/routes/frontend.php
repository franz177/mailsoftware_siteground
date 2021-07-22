<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [App\Http\Controllers\Typo\PrenotazioniController::class, 'index']);

Route::resource('/prenotazioni', \App\Http\Controllers\Typo\PrenotazioniController::class);
Route::resource('/storico', \App\Http\Controllers\Typo\StoricoController::class);

Route::get('/viste/dashboard', [\App\Http\Controllers\Frontend\Views\DashboardController::class, 'index']);
Route::get('/viste/mensile', [\App\Http\Controllers\Frontend\Views\MensileController::class, 'index']);
Route::get('/viste/viste', [\App\Http\Controllers\Frontend\Views\VisteController::class, 'index']);
Route::get('/viste/mensile/data', [\App\Http\Controllers\Frontend\Views\MensileController::class, 'getDataTable'])->name('viste.data');

Route::get('/threads/create/{pren_uid?}', [App\Http\Controllers\Frontend\ThreadController::class, 'create']);
Route::get('/threads/get_text', [\App\Http\Controllers\Frontend\ThreadController::class, 'get_text' ])->name('threads.get_text');
Route::get('/threads/thread_exist', [\App\Http\Controllers\Frontend\ThreadController::class, 'thread_exist' ])->name('threads.thread_exist');
Route::get('/threads/refresh_text', [\App\Http\Controllers\Frontend\ThreadController::class, 'refreshText' ])->name('threads.refresh_text');
Route::get('/threads/{id}', [\App\Http\Controllers\Frontend\ThreadController::class, 'show' ])->name('threads.show');
Route::post('/threads/store', [\App\Http\Controllers\Frontend\ThreadController::class, 'store' ])->name('threads.store');
Route::get('/testi/getText/{id}', [\App\Http\Controllers\Backoffice\TextController::class, 'getText'])->name('testi.getText');

Route::resource('/whatsapp', \App\Http\Controllers\Backoffice\WhatsappController::class);



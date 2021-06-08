<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', [App\Http\Controllers\PagesController::class, 'index']);


// Demo routes
Route::get('/datatables', [App\Http\Controllers\PagesController::class, 'datatables']);
Route::get('/ktdatatables', [App\Http\Controllers\PagesController::class, 'ktDatatables']);
Route::get('/select2', [App\Http\Controllers\PagesController::class, 'select2']);
Route::get('/jquerymask', [App\Http\Controllers\PagesController::class, 'jQueryMask']);
Route::get('/icons/custom-icons', [App\Http\Controllers\PagesController::class, 'customIcons']);
Route::get('/icons/flaticon', [App\Http\Controllers\PagesController::class, 'flaticon']);
Route::get('/icons/fontawesome', [App\Http\Controllers\PagesController::class, 'fontawesome']);
Route::get('/icons/lineawesome', [App\Http\Controllers\PagesController::class, 'lineawesome']);
Route::get('/icons/socicons', [App\Http\Controllers\PagesController::class, 'socicons']);
Route::get('/icons/svg', [App\Http\Controllers\PagesController::class, 'svg']);

// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', [App\Http\Controllers\PagesController::class, 'quickSearch'])->name('quick-search');

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
/*
 * GET          /ztl            function Index()                        * GET	        /ztl	            index	    ztl.index
 * GET          /ztl/create     function Create()                       * GET	        /ztl/create	        create	    ztl.create
 * POST         /ztl            function Store(Request $request)        * POST	        /ztl	            store	    ztl.store
 * GET          /ztl/{id}       function Show($id)                      * GET	        /ztl/{$id}	        show	    ztl.show
 * GET          /ztl/{id}/edit  function Edit($id)                      * GET	        /ztl/{$id}/edit	    edit	    ztl.edit
 * PUT/PATCH    /ztl/{id}       function Update(Request $request, $id)  * PUT/PATCH	    /ztl/{$id}	        update	    ztl.update
 * DELETE       /ztl/{id}       function Destroy($id)                   * DELETE	    /ztl/{$id}	        destroy	    ztl.destroy
 * */

Route::resource('/', \App\Http\Controllers\Backoffice\DashboardController::class);

//ROUTES HOUSES, OPERATORS AND SETTINGS
Route::resource('/casa', \App\Http\Controllers\Backoffice\HouseController::class);
Route::resource('/operatore', \App\Http\Controllers\Backoffice\OperatorController::class);
Route::resource('/users', \App\Http\Controllers\Backoffice\UserController::class);
Route::resource('/camera', \App\Http\Controllers\Backoffice\RoomController::class);
Route::resource('/banca', \App\Http\Controllers\Backoffice\BankController::class);
Route::resource('/ztl', \App\Http\Controllers\Backoffice\ZtlController::class);
Route::resource('/priorities', \App\Http\Controllers\Backoffice\PriorityController::class);
Route::resource('/cities', \App\Http\Controllers\Backoffice\CityController::class);
Route::resource('/citytaxs', \App\Http\Controllers\Backoffice\CityTaxController::class);

//ROUTES FLOW, TEXT AND SETTINGS
Route::resource('/tiporisposta', \App\Http\Controllers\Backoffice\TypeanswerController::class);
Route::resource('/modello', \App\Http\Controllers\Backoffice\TypeController::class);
Route::resource('/flusso', \App\Http\Controllers\Backoffice\FlowController::class);
Route::resource('/testi', \App\Http\Controllers\Backoffice\TextController::class);

//ROUTES FLOW_TEXT
Route::get('/flusso_testi/types', [\App\Http\Controllers\Backoffice\FlowTextController::class, 'types' ])->name('flusso_testi.types');
Route::get('/flusso_testi/types_answer', [\App\Http\Controllers\Backoffice\FlowTextController::class, 'types_answer' ])->name('flusso_testi.types_answer');
Route::get('/flusso_testi/sites', [\App\Http\Controllers\Backoffice\FlowTextController::class, 'sites' ])->name('flusso_testi.sites');
Route::get('/flusso_testi/houses', [\App\Http\Controllers\Backoffice\FlowTextController::class, 'houses' ])->name('flusso_testi.houses');
Route::get('/flusso_testi/getFlussiTesto', [\App\Http\Controllers\Backoffice\FlowTextController::class, 'getFlussiTesto' ])->name('flusso_testi.getFlussiTesto');
Route::get('/flusso_testi/getFlowTextIndex', [\App\Http\Controllers\Backoffice\FlowTextController::class, 'getFlowTextIndex' ])->name('flusso_testi.getFlowTextIndex');
Route::get('/flusso_testi/perview_text', [\App\Http\Controllers\Backoffice\FlowTextController::class, 'perview_text' ])->name('flusso_testi.preview_text');

Route::get('/flusso_testi', [\App\Http\Controllers\Backoffice\FlowTextController::class, 'index' ])->name('flusso_testi.index');
Route::post('/flusso_testi', [\App\Http\Controllers\Backoffice\FlowTextController::class, 'index' ])->name('flusso_testi.retrive');
Route::post('/flusso_testi/store', [\App\Http\Controllers\Backoffice\FlowTextController::class, 'store' ])->name('flusso_testi.store');
Route::get('/flusso_testi/create/{text_id?}', [\App\Http\Controllers\Backoffice\FlowTextController::class, 'create' ]);
Route::post('/flusso_testi/edit', [\App\Http\Controllers\Backoffice\FlowTextController::class, 'edit' ])->name('flusso_testi.edit');
Route::post('/flusso_testi/update', [\App\Http\Controllers\Backoffice\FlowTextController::class, 'update'])->name('flusso_testi.update');
Route::delete('/flusso_testi/destroy', [\App\Http\Controllers\Backoffice\FlowTextController::class, 'destroy'])->name('flusso_testi.destroy');


//ROUTES TESTO_UTENTI
Route::get('/testo_utenti/create/{text_id?}', [\App\Http\Controllers\Backoffice\TextUserController::class, 'create' ]);
Route::post('/testo_utenti/store', [\App\Http\Controllers\Backoffice\TextUserController::class, 'store' ])->name('testo_utenti.store');





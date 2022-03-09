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

Route::get('/threads/create/{pren_uid?}', [App\Http\Controllers\Frontend\ThreadController::class, 'create']);
Route::get('/threads/get_text', [\App\Http\Controllers\Frontend\ThreadController::class, 'get_text' ])->name('threads.get_text');
Route::get('/threads/thread_exist', [\App\Http\Controllers\Frontend\ThreadController::class, 'thread_exist' ])->name('threads.thread_exist');
Route::get('/threads/refresh_text', [\App\Http\Controllers\Frontend\ThreadController::class, 'refreshText' ])->name('threads.refresh_text');
Route::get('/threads/{id}', [\App\Http\Controllers\Frontend\ThreadController::class, 'show' ])->name('threads.show');
Route::post('/threads/store', [\App\Http\Controllers\Frontend\ThreadController::class, 'store' ])->name('threads.store');
Route::get('/testi/getText/{id}', [\App\Http\Controllers\Backoffice\TextController::class, 'getText'])->name('testi.getText');

Route::resource('/whatsapp', \App\Http\Controllers\Backoffice\WhatsappController::class);

// VISTE
Route::get('/viste/dashboard', [\App\Http\Controllers\Frontend\Views\DashboardController::class, 'index']);
Route::get('/viste/viste', [\App\Http\Controllers\Frontend\Views\VisteController::class, 'index'])->name('viste.index');
Route::get('/viste/viste/refresh', [\App\Http\Controllers\Frontend\Views\VisteController::class, 'getDataForm'])->name('viste.refresh');
Route::post('/viste/table',[\App\Http\Controllers\Frontend\Views\VisteController::class, 'getTable'])->name('viste.getTable');

Route::get('/viste/mensile', [\App\Http\Controllers\Frontend\Views\MensileController::class, 'index']);
Route::get('/viste/mensile/operatori', [\App\Http\Controllers\Frontend\Views\MensileController::class, 'indexOperatori']);
Route::get('/viste/mensile/totali_operatori', [\App\Http\Controllers\Frontend\Views\MensileController::class, 'indexTotaliOperatori']);
Route::get('/viste/mensile/dataoperatori', [\App\Http\Controllers\Frontend\Views\MensileController::class, 'getDataOperatori'])->name('viste.operatori');
Route::get('/viste/mensile/datatotalioperatori', [\App\Http\Controllers\Frontend\Views\MensileController::class, 'getDataTotaliOperatori'])->name('viste.totali_operatori');
Route::get('/viste/mensile/datas', [\App\Http\Controllers\Frontend\Views\MensileController::class, 'getDataTables'])->name('viste.datas');

// COSTI ANNUALI MESI E ANNO
Route::get('/viste/mensile/costi_annuale_mesi', [\App\Http\Controllers\Frontend\Views\SimonettaController::class, 'index']);
Route::get('/viste/mensile/costi_annuale_mesi/data', [\App\Http\Controllers\Frontend\Views\SimonettaController::class, 'getDataTables'])->name('costi_annuale_mesi.data');
Route::get('/viste/mensile/costi_annuale_anno', [\App\Http\Controllers\Frontend\Views\SimonettaController::class, 'indexAnno']);
Route::get('/viste/mensile/costi_annuale_anno/data', [\App\Http\Controllers\Frontend\Views\SimonettaController::class, 'getDataTablesYears'])->name('costi_annuale_anno.data');

Route::get('/booking', [\App\Http\Controllers\BookingController::class, 'index']);
Route::get('/booking/force', [\App\Http\Controllers\BookingController::class, 'force'])->name('booking_force');

// SPESE
Route::get('/spese/categorie', [\App\Http\Controllers\Frontend\Storico\TypoCategoriesController::class, 'index']);
Route::get('/spese/costi_aziendali', [\App\Http\Controllers\Frontend\Views\Spese\SpeseController::class, 'indexCostiAziendali']);
Route::get('/spese/costi_aziendali/data', [\App\Http\Controllers\Frontend\Views\Spese\SpeseController::class, 'getDataCostiAziendali'])->name('costi_aziendali.data');
Route::get('/spese/costi_aziendali/data_anno', [\App\Http\Controllers\Frontend\Views\Spese\SpeseController::class, 'getDataCostiAziendaliAnno'])->name('costi_aziendali_anno.data');

//INCASSI

// MARKETING
Route::get('/marketing/countries', [\App\Http\Controllers\Frontend\Views\Marketing\CountriesController::class, 'index'])->name('countries.index');
Route::get('/marketing/countries/data', [\App\Http\Controllers\Frontend\Views\Marketing\CountriesController::class, 'getCountriesTable'])->name('countries.table');

// EXPORT GLOBALE DELLE PRENOTAZIONI IN EXCEL
Route::get('/excel', [\App\Http\Controllers\Frontend\Excel\ExcelController::class, 'index'])->name('excel.index');
Route::get('/excel/export', [\App\Http\Controllers\Frontend\Excel\ExcelController::class, 'bookingsExport'])->name('excel.export');
Route::post('/excel/custom_export', [\App\Http\Controllers\Frontend\Excel\ExcelController::class, 'bookingsCustomExport'])->name('excel.custom_export');
Route::get('/excel/download_custom_export/{filename?}', [\App\Http\Controllers\Frontend\Excel\ExcelController::class, 'downloadBookingCustomExport'])->name('excel.download_custom_export');

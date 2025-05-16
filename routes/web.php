<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\FiscalYearController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('setting')->group(function () {
    Route::prefix('general-setting')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('setting.index');
        Route::post('/', [SettingController::class, 'doctorino_settings_store'])->name('doctorino_settings.store');
    });

    Route::prefix('fiscal-year')->group(function () {
        Route::get('/', [FiscalYearController::class, 'index'])->name('fiscal.year.index');
        Route::post('/store', [FiscalYearController::class, 'store'])->name('fiscal.year.store');
        Route::get('/{fiscalYear}/edit', [FiscalYearController::class, 'edit'])->name('fiscal.year.edit');
        Route::put('/{fiscalYear}/update', [FiscalYearController::class, 'update'])->name('fiscal.year.update');
        Route::delete('/{fiscalYear}/delete', [FiscalYearController::class, 'delete'])->name('fiscal.year.delete');
    });

    Route::prefix('test')->group(function () {
        Route::get('/create', [TestController::class, 'create'])->name('test.create');
        Route::post('/create', [TestController::class, 'store'])->name('test.store');
        Route::get('/edit/{id}', [TestController::class, 'edit'])->name('test.edit');
        Route::post('/edit', [TestController::class, 'store_edit'])->name('test.store_edit');
        Route::get('/all', [TestController::class, 'all'])->name('test.all');
        Route::get('/delete/{id}', [TestController::class, 'destroy'])->where('id', '[0-9]+')->name('test.delete');
    });


});





Route::get('google/login', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('google/docs', [GoogleController::class, 'listDocs']);


Route::get('/google/create-doc\{testId}', [GoogleController::class, 'createGoogleDoc'])->name('format-create');

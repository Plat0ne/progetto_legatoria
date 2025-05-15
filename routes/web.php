<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{AuthenticationController, DashboardController, UserControllerAdmin, StatisticheController};
use App\Http\Controllers\Admin\{LavorazioniTaglioController, LavorazioniBrossuraController, LavorazioniCucituraController, LavorazioniRaccoltaController, LavorazioniPiegaController};
use App\Http\Controllers\{WelcomeController, WorkerController, ProduzioneController};

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::prefix('produzione')->name('produzione.')->group(function () {
    Route::get('/home', [ProduzioneController::class, 'home'])->name('home');

    #Routes produzione Taglio
    Route::get('/taglio', [ProduzioneController::class, 'taglio'])->name('taglio');
    Route::post('/taglio/entrata',[ProduzioneController::class, 'entrata_taglio'])->name('taglio.entrata'); //praticamente una store
    Route::post('/taglio/uscita/{id_lavorazione}',[ProduzioneController::class, 'uscita_taglio'])->name('taglio.uscita'); //praticamente un update
    #Routes produzione Piega
    Route::get('/piega', [ProduzioneController::class, 'piega'])->name('piega');
    Route::post('/piega/entrata',[ProduzioneController::class, 'entrata_piega'])->name('piega.entrata');
    Route::post('/piega/uscita/{id_lavorazione}',[ProduzioneController::class, 'uscita_piega'])->name('piega.uscita');
    #Routes produzione Raccolta
    Route::get('/raccolta', [ProduzioneController::class, 'raccolta'])->name('raccolta');
    Route::post('/raccolta/entrata',[ProduzioneController::class, 'entrata_raccolta'])->name('raccolta.entrata');
    Route::post('/raccolta/uscita/{id_lavorazione}',[ProduzioneController::class, 'uscita_raccolta'])->name('raccolta.uscita');
    #Routes produzione Cucitura
    Route::get('/cucitura', [ProduzioneController::class, 'cucitura'])->name('cucitura');
    Route::post('/cucitura/entrata',[ProduzioneController::class, 'entrata_cucitura'])->name('cucitura.entrata');
    Route::post('/cucitura/uscita/{id_lavorazione}',[ProduzioneController::class, 'uscita_cucitura'])->name('cucitura.uscita');
    
    Route::get('/brossura', [ProduzioneController::class, 'brossura'])->name('brossura');
    Route::post('/brossura/entrata',[ProduzioneController::class, 'entrata_brossura'])->name('brossura.entrata');
    Route::post('/brossura/uscita/{id_lavorazione}',[ProduzioneController::class, 'uscita_brossura'])->name('brossura.uscita');


});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthenticationController::class, 'ottineni_pagina_login'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'tentativoLogin'])->name('tentativoLogin');
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});


Route::middleware(['controlloSessione'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
      
        //routes per gli utenti CRUD: 
        Route::post('/utenti', [UserControllerAdmin::class, 'store'])->name('utenti.store');
        Route::get('/utenti', [UserControllerAdmin::class, 'index'])->name('utenti.index');
        Route::put('/utenti/{user}', [UserControllerAdmin::class, 'update'])->name('utenti.update');
        Route::delete('/utenti/{user}', [UserControllerAdmin::class, 'destroy'])->name('utenti.destroy');

        //routes per le statistiche
        Route::prefix('statistiche')->group(function () {
            Route::get('/fasi', [StatisticheController::class, 'genera_report_fasi'])->name(('statistiche.fasi'));
            Route::get('/orari', [StatisticheController::class, 'genera_report_orari'])->name(('statistiche.orari'));

        });
    });
    
    //routes per gli operatori CRUD:
    Route::post("/operatori", [WorkerController::class, 'store'])->name('operatori.store');
    Route::get("/operatori", [WorkerController::class, 'index'])->name('operatori.index');
    Route::put("/operatori/{worker}", [WorkerController::class, 'update'])->name('operatori.update');
    Route::delete("/operatori/{worker}", [WorkerController::class, 'destroy'])->name('operatori.destroy');

    Route::prefix('lavorazioni')->name('lavorazioni.')->group(function () {
        Route::get('/taglio', [LavorazioniTaglioController::class, 'index'])->name('taglio');
        Route::get('/piega', [LavorazioniPiegaController::class, 'index'])->name('piega');
        Route::get('/raccolta', [LavorazioniRaccoltaController::class, 'index'])->name('raccolta');
        Route::get('/cucitura', [LavorazioniCucituraController::class, 'index'])->name('cucitura');
        Route::get('/brossura', [LavorazioniBrossuraController::class, 'index'])->name('brossura');
    });
});


Route::fallback(function () {
    return redirect()->route('welcome');
});
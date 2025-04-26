<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{AuthenticationController, DashboardController, UserControllerAdmin, StatisticheController};
use App\Http\Controllers\Admin\{LavorazioniTaglioController, LavorazioniBrossuraController, LavorazioniCucituraController, LavorazioniRaccoltaController, LavorazioniPiegaController};
use App\Http\Controllers\{WelcomeController, WorkerController};

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

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
            Route::get('/orari', [StatisticheController::class, 'genera_report_orari'])->name(('statistiche.fasi'));

        });
    });

    //routes per gli operatori CRUD:
    Route::post("/operatori", [WorkerController::class, 'store'])->name('operatori.store');
    Route::get("/operatori", [WorkerController::class, 'index'])->name('operatori.index');
    Route::put("/operatori/{worker}", [WorkerController::class, 'update'])->name('operatori.update');
    Route::delete("/operatori/{worker}", [WorkerController::class, 'destroy'])->name('operatori.destroy');

    //routes per le lavorazioni:
    Route::get("lavorazioni/taglio", [LavorazioniTaglioController::class, 'index'])->name('lavorazioni_taglio.index');
    Route::get("lavorazioni/piega", [LavorazioniPiegaController::class, 'index'])->name('lavorazioni_piega.index');
    Route::get("lavorazioni/raccolta", [LavorazioniRaccoltaController::class, 'index'])->name('lavorazioni_raccolta.index');
    Route::get("lavorazioni/cucitura", [LavorazioniCucituraController::class, 'index'])->name('lavorazioni_cucitura.index');
    Route::get("lavorazioni/brossura", [LavorazioniBrossuraController::class, 'index'])->name('lavorazioni_brossura.index');

});



Route::fallback(function () {
    return redirect()->route('welcome');
});
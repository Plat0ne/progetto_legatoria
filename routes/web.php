<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{AuthenticationController, DashboardController, UserControllerAdmin,LavorazioniTaglioController};
use App\Http\Controllers\{WelcomeController, WorkerController};



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthenticationController::class, 'ottineni_pagina_login'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'tentativoLogin'])->name('tentativoLogin');
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});
// simile a fare:
// Route::get('/admin/login', [AuthenticationController::class, 'ottineni_pagina_login'])->name('admin.login');
// Route::post('/admin/login', [AuthenticationController::class, 'tentativoLogin'])->name('admin.tentativoLogin');
// Route::post(uri: '/admin/logout', action: [AuthenticationController::class, 'logout'])->name('admin.logout');


Route::get('/', [WelcomeController::class, 'index'])->name('welcome');


Route::middleware(['controlloSessione'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        // Route::resource('/utenti', UserControllerAdmin::class); 
        #alternativa a fare queste rotte in un' unica riga come resource
        #rotte CRUD utenti
        Route::post('/utenti', [UserControllerAdmin::class, 'store'])->name('utenti.store');
        Route::get('/utenti', [UserControllerAdmin::class, 'index'])->name('utenti.index');
        Route::put('/utenti/{user}', [UserControllerAdmin::class, 'update'])->name('utenti.update');
        Route::delete('/utenti/{user}', [UserControllerAdmin::class, 'destroy'])->name('utenti.destroy');
    });

    //Route::resource('/operatori', WorkerController::class);

    Route::post("/operatori", [WorkerController::class, 'store'])->name('operatori.store');
    Route::get("/operatori", [WorkerController::class, 'index'])->name('operatori.index');
    Route::put("/operatori/{worker}", [WorkerController::class, 'update'])->name('operatori.update');
    Route::delete("/operatori/{worker}", [WorkerController::class, 'destroy'])->name('operatori.destroy');

    //routes per le lavorazioni:
    Route::get("/lavorazioni_taglio", [LavorazioniTaglioController::class, 'index'])->name('lavorazioni_taglio.index');

});



Route::fallback(function () {
    return redirect()->route('welcome');
    
});
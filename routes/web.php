<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\Accounts\COA\ClassController;
use App\Http\Controllers\Accounts\COA\SubClassController;
use App\Http\Controllers\Accounts\COA\LedgerGroupController;

// home
Route::get('/', [HomeController::class,'index']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard',[HomeController::class,'home'])->name('dashboard');

    //Accounts/coa/class
    Route::get('/accounts/coa/class/',[ClassController::class,'index'])->name('acc.class.view');
    Route::get('/accounts/coa/class/create', [ClassController::class,'create'])->name('acc.class.create');
    Route::post('/accounts/coa/class/store', [ClassController::class,'store'])->name('acc.class.store');
    Route::get('/accounts/coa/class/show/{id}', [ClassController::class,'show'])->name('acc.class.show');
    Route::get('/accounts/coa/class/edit/{id}', [ClassController::class,'edit'])->name('acc.class.edit');
    Route::post('/accounts/coa/class/update/{id}', [ClassController::class,'update'])->name('acc.class.update');
    Route::post('/accounts/coa/class/destroy/{id}', [ClassController::class,'destroy'])->name('acc.class.destroy');

    //Accounts/coa/sub-class
    Route::get('/accounts/coa/sub-class/',[SubClassController::class,'index'])->name('acc.sub-class.view');
    Route::get('/accounts/coa/sub-class/create', [SubClassController::class,'create'])->name('acc.sub-class.create');
    Route::post('/accounts/coa/sub-class/store', [SubClassController::class,'store'])->name('acc.sub-class.store');
    Route::get('/accounts/coa/sub-class/show', [SubClassController::class,'show'])->name('acc.sub-class.show');
    Route::get('/accounts/coa/sub-class/edit/{id}', [SubClassController::class,'edit'])->name('acc.sub-class.edit');
    Route::post('/accounts/coa/sub-class/update/{id}', [SubClassController::class,'update'])->name('acc.sub-class.update');
    Route::post('/accounts/coa/sub-class/destroy/{id}', [SubClassController::class,'destroy'])->name('acc.sub-class.destroy');

    //Accounts/coa/ledger-group
    Route::get('/accounts/coa/ledger-group/',[LedgerGroupController::class,'index'])->name('acc.ledger-group.view');
    Route::get('/accounts/coa/ledger-group/create', [LedgerGroupController::class,'create'])->name('acc.ledger-group.create');
    Route::post('/accounts/coa/ledger-group/store', [LedgerGroupController::class,'store'])->name('acc.ledger-group.store');
    Route::get('/accounts/coa/ledger-group/show', [LedgerGroupController::class,'show'])->name('acc.ledger-group.show');
    Route::get('/accounts/coa/ledger-group/edit/{id}', [LedgerGroupController::class,'edit'])->name('acc.ledger-group.edit');
    Route::post('/accounts/coa/ledger-group/update/{id}', [LedgerGroupController::class,'update'])->name('acc.ledger-group.update');
    Route::post('/accounts/coa/ledger-group/destroy/{id}', [LedgerGroupController::class,'destroy'])->name('acc.ledger-group.destroy');

});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\Accounts\COA\ClassController;
use App\Http\Controllers\Accounts\COA\SubClassController;
use App\Http\Controllers\Accounts\COA\LedgerGroupController;
use App\Http\Controllers\Accounts\COA\LedgerController;
use App\Http\Controllers\Accounts\COA\SubLedgerController;

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
    Route::get('/accounts/coa/ledger-group/get-all-sub-class', [LedgerGroupController::class,'getAllSubClass'])->name('acc.get-all-sub-class');
    Route::get('/accounts/coa/ledger-group/create', [LedgerGroupController::class,'create'])->name('acc.ledger-group.create');
    Route::post('/accounts/coa/ledger-group/store', [LedgerGroupController::class,'store'])->name('acc.ledger-group.store');
    Route::get('/accounts/coa/ledger-group/show/{id}', [LedgerGroupController::class,'show'])->name('acc.ledger-group.show');
    Route::get('/accounts/coa/ledger-group/edit/{id}', [LedgerGroupController::class,'edit'])->name('acc.ledger-group.edit');
    Route::post('/accounts/coa/ledger-group/update/{id}', [LedgerGroupController::class,'update'])->name('acc.ledger-group.update');
    Route::post('/accounts/coa/ledger-group/destroy/{id}', [LedgerGroupController::class,'destroy'])->name('acc.ledger-group.destroy');

    //Accounts/coa/ledger
    Route::get('/accounts/coa/ledger/',[LedgerController::class,'index'])->name('acc.ledger.view');
    Route::get('/accounts/coa/ledger/get-all-sub-class', [LedgerController::class,'getAllSubClass'])->name('acc.get-all-sub-class');
    Route::get('/accounts/coa/ledger/create', [LedgerController::class,'create'])->name('acc.ledger.create');
    Route::post('/accounts/coa/ledger/store', [LedgerController::class,'store'])->name('acc.ledger.store');
    Route::get('/accounts/coa/ledger/show/{id}', [LedgerController::class,'show'])->name('acc.ledger.show');
    Route::get('/accounts/coa/ledger/edit/{id}', [LedgerController::class,'edit'])->name('acc.ledger.edit');
    Route::post('/accounts/coa/ledger/update/{id}', [LedgerController::class,'update'])->name('acc.ledger.update');
    Route::post('/accounts/coa/ledger/destroy/{id}', [LedgerController::class,'destroy'])->name('acc.ledger.destroy');

    //Accounts/coa/ledger
    Route::get('/accounts/coa/sub-ledger/',[SubLedgerController::class,'index'])->name('acc.sub-ledger.view');
    Route::get('/accounts/coa/sub-ledger/create', [SubLedgerController::class,'create'])->name('acc.sub-ledger.create');
    Route::post('/accounts/coa/sub-ledger/store', [SubLedgerController::class,'store'])->name('acc.sub-ledger.store');
    Route::get('/accounts/coa/sub-ledger/show/{id}', [SubLedgerController::class,'show'])->name('acc.sub-ledger.show');
    Route::get('/accounts/coa/sub-ledger/edit/{id}', [SubLedgerController::class,'edit'])->name('acc.sub-ledger.edit');
    Route::post('/accounts/coa/sub-ledger/update/{id}', [SubLedgerController::class,'update'])->name('acc.sub-ledger.update');
    Route::post('/accounts/coa/sub-ledger/destroy/{id}', [SubLedgerController::class,'destroy'])->name('acc.sub-ledger.destroy');

});

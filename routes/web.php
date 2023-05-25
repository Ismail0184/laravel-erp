<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\Accounts\COA\ClassController;
use App\Http\Controllers\Accounts\COA\SubClassController;
use App\Http\Controllers\Accounts\COA\LedgerGroupController;
use App\Http\Controllers\Accounts\COA\LedgerController;
use App\Http\Controllers\Accounts\COA\SubLedgerController;
use App\Http\Controllers\Accounts\COA\SubSubLedgerController;
use App\Http\Controllers\Accounts\COA\CostCategoryController;
use App\Http\Controllers\Accounts\COA\CostCenterController;
use App\Http\Controllers\Developer\ModulesController;


// home
Route::get('/', [HomeController::class,'index']);

    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard',[HomeController::class,'home'])->name('dashboard');
    Route::get('/dashboard/module_id/{module_id}', function (Request $request){ session(['module_id'=>request('module_id')]);
        return redirect('/dashboard');
    });




    //Developer/Modules
    Route::get('/developer/company/',[ClassController::class,'index'])->name('dev.company.view');
    Route::get('/developer/company/create', [ClassController::class,'create'])->name('dev.company.create');
    Route::post('/developer/company/store', [ClassController::class,'store'])->name('dev.company.store');
    Route::get('/developer/company/show/{id}', [ClassController::class,'show'])->name('dev.company.show');
    Route::get('/developer/company/edit/{id}', [ClassController::class,'edit'])->name('dev.company.edit');
    Route::post('/developer/company/update/{id}', [ClassController::class,'update'])->name('dev.company.update');
    Route::post('developer/company/destroy/{id}', [ClassController::class,'destroy'])->name('dev.company.destroy');

    //Developer/Modules
    Route::get('/developer/modules/',[ModulesController::class,'index'])->name('dev.modules.view');
    Route::get('/developer/modules/create', [ModulesController::class,'create'])->name('dev.modules.create');
    Route::post('/developer/modules/store', [ModulesController::class,'store'])->name('dev.modules.store');
    Route::get('/developer/modules/show/{id}', [ModulesController::class,'show'])->name('dev.modules.show');
    Route::get('/developer/modules/edit/{id}', [ModulesController::class,'edit'])->name('dev.modules.edit');
    Route::post('/developer/modules/update/{id}', [ModulesController::class,'update'])->name('dev.modules.update');
    Route::post('developer/modules/destroy/{id}', [ModulesController::class,'destroy'])->name('dev.modules.destroy');



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
    Route::get('/accounts/coa/ledger/show/{ledger_id}', [LedgerController::class,'show'])->name('acc.ledger.show');
    Route::get('/accounts/coa/ledger/edit/{ledger_id}', [LedgerController::class,'edit'])->name('acc.ledger.edit');
    Route::post('/accounts/coa/ledger/update/{ledger_id}', [LedgerController::class,'update'])->name('acc.ledger.update');
    Route::post('/accounts/coa/ledger/destroy/{ledger_id}', [LedgerController::class,'destroy'])->name('acc.ledger.destroy');

    //Accounts/coa/sub-ledger
    Route::get('/accounts/coa/sub-ledger/',[SubLedgerController::class,'index'])->name('acc.sub-ledger.view');
    Route::get('/accounts/coa/sub-ledger/create', [SubLedgerController::class,'create'])->name('acc.sub-ledger.create');
    Route::post('/accounts/coa/sub-ledger/store', [SubLedgerController::class,'store'])->name('acc.sub-ledger.store');
    Route::get('/accounts/coa/sub-ledger/show/{sub_ledger_id}', [SubLedgerController::class,'show'])->name('acc.sub-ledger.show');
    Route::get('/accounts/coa/sub-ledger/edit/{sub_ledger_id}', [SubLedgerController::class,'edit'])->name('acc.sub-ledger.edit');
    Route::post('/accounts/coa/sub-ledger/update/{sub_ledger_id}', [SubLedgerController::class,'update'])->name('acc.sub-ledger.update');
    Route::post('/accounts/coa/sub-ledger/destroy/{sub_ledger_id}', [SubLedgerController::class,'destroy'])->name('acc.sub-ledger.destroy');

    //Accounts/coa/sub-sub-ledger
    Route::get('/accounts/coa/sub-sub-ledger/',[SubSubLedgerController::class,'index'])->name('acc.sub-sub-ledger.view');
    Route::get('/accounts/coa/sub-sub-ledger/create', [SubSubLedgerController::class,'create'])->name('acc.sub-sub-ledger.create');
    Route::post('/accounts/coa/sub-sub-ledger/store', [SubSubLedgerController::class,'store'])->name('acc.sub-sub-ledger.store');
    Route::get('/accounts/coa/sub-sub-ledger/show/{sub_sub_ledger_id}', [SubSubLedgerController::class,'show'])->name('acc.sub-sub-ledger.show');
    Route::get('/accounts/coa/sub-sub-ledger/edit/{sub_sub_ledger_id}', [SubSubLedgerController::class,'edit'])->name('acc.sub-sub-ledger.edit');
    Route::post('/accounts/coa/sub-sub-ledger/update/{sub_sub_ledger_id}', [SubSubLedgerController::class,'update'])->name('acc.sub-sub-ledger.update');
    Route::post('/accounts/coa/sub-sub-ledger/destroy/{sub_sub_ledger_id}', [SubSubLedgerController::class,'destroy'])->name('acc.sub-sub-ledger.destroy');

    //Accounts/coa/Cost-Category
    Route::get('/accounts/coa/cost-category/',[CostCategoryController::class,'index'])->name('acc.cost-category.view');
    Route::get('/accounts/coa/cost-category/create', [CostCategoryController::class,'create'])->name('acc.cost-category.create');
    Route::post('/accounts/coa/cost-category/store', [CostCategoryController::class,'store'])->name('acc.cost-category.store');
    Route::get('/accounts/coa/cost-category/show/{id}', [CostCategoryController::class,'show'])->name('acc.cost-category.show');
    Route::get('/accounts/coa/cost-category/edit/{id}', [CostCategoryController::class,'edit'])->name('acc.cost-category.edit');
    Route::post('/accounts/coa/cost-category/update/{id}', [CostCategoryController::class,'update'])->name('acc.cost-category.update');
    Route::post('/accounts/coa/cost-category/destroy/{id}', [CostCategoryController::class,'destroy'])->name('acc.cost-category.destroy');

    //Accounts/coa/Cost-Center
    Route::get('/accounts/coa/cost-center/',[CostCenterController::class,'index'])->name('acc.cost-center.view');
    Route::get('/accounts/coa/cost-center/create', [CostCenterController::class,'create'])->name('acc.cost-center.create');
    Route::post('/accounts/coa/cost-center/store', [CostCenterController::class,'store'])->name('acc.cost-center.store');
    Route::get('/accounts/coa/cost-center/show/{cc_code}', [CostCenterController::class,'show'])->name('acc.cost-center.show');
    Route::get('/accounts/coa/cost-center/edit/{cc_code}', [CostCenterController::class,'edit'])->name('acc.cost-center.edit');
    Route::post('/accounts/coa/cost-center/update/{cc_code}', [CostCenterController::class,'update'])->name('acc.cost-center.update');
    Route::post('/accounts/coa/cost-center/destroy/{cc_code}', [CostCenterController::class,'destroy'])->name('acc.cost-center.destroy');

});

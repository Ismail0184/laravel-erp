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
use App\Http\Controllers\Developer\MainMenuController;
use App\Http\Controllers\Developer\SubMenuController;
use App\Http\Controllers\Accounts\Vouchers\ReceiptVoucherController;
use App\Http\Controllers\Accounts\Vouchers\PaymentVoucherController;
use App\Http\Controllers\Accounts\Vouchers\VoucherMasterController;
use App\Http\Controllers\Accounts\Vouchers\JournalVoucherController;
use App\Http\Controllers\Accounts\COA\COAController;


// home
Route::get('/', [HomeController::class,'index']);

    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard',[HomeController::class,'home'])->name('dashboard');
    Route::get('/dashboard/module_id/{module_id}', function (Request $request){ session(['module_id'=>request('module_id')]);
        return redirect('/dashboard');
    });

    //Developer/Company
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
    Route::get('/developer/modules/show/{module_id}', [ModulesController::class,'show'])->name('dev.modules.show');
    Route::get('/developer/modules/edit/{module_id}', [ModulesController::class,'edit'])->name('dev.modules.edit');
    Route::post('/developer/modules/update/{module_id}', [ModulesController::class,'update'])->name('dev.modules.update');
    Route::post('developer/modules/destroy/{module_id}', [ModulesController::class,'destroy'])->name('dev.modules.destroy');

    //Developer/Main Menu
    Route::get('/developer/main-menu/',[MainMenuController::class,'index'])->name('dev.main-menu.view');
    Route::get('/developer/main-menu/create', [MainMenuController::class,'create'])->name('dev.main-menu.create');
    Route::post('/developer/main-menu/store', [MainMenuController::class,'store'])->name('dev.main-menu.store');
    Route::get('/developer/main-menu/show/{main_menu_id}', [MainMenuController::class,'show'])->name('dev.main-menu.show');
    Route::get('/developer/main-menu/edit/{main_menu_id}', [MainMenuController::class,'edit'])->name('dev.main-menu.edit');
    Route::post('/developer/main-menu/update/{main_menu_id}', [MainMenuController::class,'update'])->name('dev.main-menu.update');
    Route::post('developer/main-menu/destroy/{main_menu_id}', [MainMenuController::class,'destroy'])->name('dev.main-menu.destroy');

    //Developer/Sub Menu
    Route::get('/developer/sub-menu/',[SubMenuController::class,'index'])->name('dev.sub-menu.view');
    Route::get('/developer/sub-menu/create', [SubMenuController::class,'create'])->name('dev.sub-menu.create');
    Route::post('/developer/sub-menu/store', [SubMenuController::class,'store'])->name('dev.sub-menu.store');
    Route::get('/developer/sub-menu/show/{main_menu_id}', [SubMenuController::class,'show'])->name('dev.sub-menu.show');
    Route::get('/developer/sub-menu/edit/{main_menu_id}', [SubMenuController::class,'edit'])->name('dev.sub-menu.edit');
    Route::post('/developer/sub-menu/update/{main_menu_id}', [SubMenuController::class,'update'])->name('dev.sub-menu.update');
    Route::post('developer/sub-menu/destroy/{main_menu_id}', [SubMenuController::class,'destroy'])->name('dev.sub-menu.destroy');

    //Accounts/coa/class
    Route::get('/accounts/coa/class/',[ClassController::class,'index'])->name('acc.class.view');
    Route::get('/accounts/coa/class/create', [ClassController::class,'create'])->name('acc.class.create');
    Route::post('/accounts/coa/class/store', [ClassController::class,'store'])->name('acc.class.store');
    Route::get('/accounts/coa/class/show/{class_id}', [ClassController::class,'show'])->name('acc.class.show');
    Route::get('/accounts/coa/class/edit/{class_id}', [ClassController::class,'edit'])->name('acc.class.edit');
    Route::post('/accounts/coa/class/update/{class_id}', [ClassController::class,'update'])->name('acc.class.update');
    Route::post('/accounts/coa/class/destroy/{class_id}', [ClassController::class,'destroy'])->name('acc.class.destroy');

    //Accounts/coa/sub-class
    Route::get('/accounts/coa/sub-class/',[SubClassController::class,'index'])->name('acc.sub-class.view');
    Route::get('/accounts/coa/sub-class/create', [SubClassController::class,'create'])->name('acc.sub-class.create');
    Route::post('/accounts/coa/sub-class/store', [SubClassController::class,'store'])->name('acc.sub-class.store');
    Route::get('/accounts/coa/sub-class/show', [SubClassController::class,'show'])->name('acc.sub-class.show');
    Route::get('/accounts/coa/sub-class/edit/{sub_class_id}', [SubClassController::class,'edit'])->name('acc.sub-class.edit');
    Route::post('/accounts/coa/sub-class/update/{sub_class_id}', [SubClassController::class,'update'])->name('acc.sub-class.update');
    Route::post('/accounts/coa/sub-class/destroy/{sub_class_id}', [SubClassController::class,'destroy'])->name('acc.sub-class.destroy');

    //Accounts/coa/ledger-group
    Route::get('/accounts/coa/ledger-group/',[LedgerGroupController::class,'index'])->name('acc.ledger-group.view');
    Route::get('/accounts/coa/ledger-group/get-all-sub-class', [LedgerGroupController::class,'getAllSubClass'])->name('acc.get-all-sub-class');
    Route::get('/accounts/coa/ledger-group/create', [LedgerGroupController::class,'create'])->name('acc.ledger-group.create');
    Route::post('/accounts/coa/ledger-group/store', [LedgerGroupController::class,'store'])->name('acc.ledger-group.store');
    Route::get('/accounts/coa/ledger-group/show/{group_id}', [LedgerGroupController::class,'show'])->name('acc.ledger-group.show');
    Route::get('/accounts/coa/ledger-group/edit/{group_id}', [LedgerGroupController::class,'edit'])->name('acc.ledger-group.edit');
    Route::post('/accounts/coa/ledger-group/update/{group_id}', [LedgerGroupController::class,'update'])->name('acc.ledger-group.update');
    Route::post('/accounts/coa/ledger-group/destroy/{group_id}', [LedgerGroupController::class,'destroy'])->name('acc.ledger-group.destroy');

    //Accounts/coa/ledger
    Route::get('/accounts/coa/ledger/',[LedgerController::class,'index'])->name('acc.ledger.view');
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

    //Accounts/coa/chart-of-account
    Route::get('/accounts/chart-of-accounts/',[COAController::class,'index'])->name('acc.chart.of.accounts.view');


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

    //Accounts/coa/create bank
    Route::get('/accounts/coa/bank/',[CostCenterController::class,'index'])->name('acc.bank.view');
    Route::get('/accounts/coa/bank/create', [CostCenterController::class,'create'])->name('acc.bank.create');
    Route::post('/accounts/coa/bank/store', [CostCenterController::class,'store'])->name('acc.bank.store');
    Route::get('/accounts/coa/bank/show/{cc_code}', [CostCenterController::class,'show'])->name('acc.bank.show');
    Route::get('/accounts/coa/bank/edit/{cc_code}', [CostCenterController::class,'edit'])->name('acc.bank.edit');
    Route::post('/accounts/coa/bank/update/{cc_code}', [CostCenterController::class,'update'])->name('acc.bank.update');
    Route::post('/accounts/coa/bank/destroy/{cc_code}', [CostCenterController::class,'destroy'])->name('acc.bank.destroy');

    //Accounts/coa/create bank
    Route::get('/accounts/coa/cbook/',[CostCenterController::class,'index'])->name('acc.cbook.view');
    Route::get('/accounts/coa/cbook/create', [CostCenterController::class,'create'])->name('acc.cbook.create');
    Route::post('/accounts/coa/cbook/store', [CostCenterController::class,'store'])->name('acc.cbook.store');
    Route::get('/accounts/coa/cbook/show/{cc_code}', [CostCenterController::class,'show'])->name('acc.cbook.show');
    Route::get('/accounts/coa/cbook/edit/{cc_code}', [CostCenterController::class,'edit'])->name('acc.cbook.edit');
    Route::post('/accounts/coa/cbook/update/{cc_code}', [CostCenterController::class,'update'])->name('acc.cbook.update');
    Route::post('/accounts/coa/cbook/destroy/{cc_code}', [CostCenterController::class,'destroy'])->name('acc.cbook.destroy');

    //Accounts/voucher/receipt voucher
    Route::get('/accounts/voucher/receipt/',[ReceiptVoucherController::class,'index'])->name('acc.voucher.receipt.view');
    Route::get('/accounts/voucher/receipt/create', [ReceiptVoucherController::class,'create'])->name('acc.voucher.receipt.create');
    Route::get('/accounts/voucher/receipt/create-multiple', [ReceiptVoucherController::class,'createMultiple'])->name('acc.voucher.receipt.multiple.create');
    Route::post('/accounts/voucher/receipt/initiate', [VoucherMasterController::class,'store'])->name('acc.voucher.receipt.initiate');
    Route::post('/accounts/voucher/receipt/mupdate/{voucher_no}', [VoucherMasterController::class,'update'])->name('acc.voucher.receipt.mupdate');
    Route::post('/accounts/voucher/receipt/confirm/{voucher_no}', [ReceiptVoucherController::class,'confirm'])->name('acc.voucher.receipt.confirm');
    Route::post('/accounts/voucher/receipt/cancelall/{voucher_no}', [VoucherMasterController::class,'destroy'])->name('acc.voucher.receipt.cancelall');
    Route::post('/accounts/voucher/receipt/store', [ReceiptVoucherController::class,'store'])->name('acc.voucher.receipt.store');
    Route::get('/accounts/voucher/receipt/show/{voucher_no}', [ReceiptVoucherController::class,'show'])->name('acc.voucher.receipt.show');
    Route::get('/accounts/voucher/receipt/download/{voucher_no}', [ReceiptVoucherController::class,'downalodvoucher'])->name('acc.voucher.receipt.download');
    Route::get('/accounts/voucher/receipt/edit/{id}', [ReceiptVoucherController::class,'edit'])->name('acc.voucher.receipt.edit');
    Route::get('/accounts/voucher/receipt/edit-multiple/{id}', [ReceiptVoucherController::class,'editMultiple'])->name('acc.voucher.receipt.editMultiple');
    Route::post('/accounts/voucher/receipt/destroy/{id}', [ReceiptVoucherController::class,'destroy'])->name('acc.voucher.receipt.destroy');
    Route::get('/accounts/voucher/receipt/voucher/edit/{voucher_no}', function (Request $request){ session(['receipt_no'=>request('voucher_no')]);
        return redirect('/accounts/voucher/receipt/create');})->name('acc.voucher.receipt.voucher.edit');
        Route::get('/accounts/voucher/receipt/voucher/edit-multiple/{voucher_no}', function (Request $request){ session(['receipt_no'=>request('voucher_no')]);
            return redirect('/accounts/voucher/receipt/create-multiple');})->name('acc.voucher.receipt.voucher.editMultiple');
    Route::post('/accounts/voucher/receipt/update/{id}', [ReceiptVoucherController::class,'update'])->name('acc.voucher.receipt.update');
    Route::post('/accounts/voucher/receipt/voucher/destroy/{voucher_no}', [VoucherMasterController::class,'deleteFullVoucher'])->name('acc.voucher.receipt.voucher.destroy');
    Route::post('/accounts/voucher/receipt/status/update/{voucher_no}', [ReceiptVoucherController::class,'statusupdate'])->name('acc.voucher.receipt.status.update');

    //Accounts/voucher/Payment Voucher
    Route::get('/accounts/voucher/payment/',[PaymentVoucherController::class,'index'])->name('acc.voucher.payment.view');
    Route::get('/accounts/voucher/payment/create', [PaymentVoucherController::class,'create'])->name('acc.voucher.payment.create');
    Route::get('/accounts/voucher/payment/create-multiple', [PaymentVoucherController::class,'createMultiple'])->name('acc.voucher.payment.multiple.create');
    Route::post('/accounts/voucher/payment/initiate', [VoucherMasterController::class,'store'])->name('acc.voucher.payment.initiate');
    Route::post('/accounts/voucher/payment/mupdate/{voucher_no}', [VoucherMasterController::class,'update'])->name('acc.voucher.payment.mupdate');
    Route::post('/accounts/voucher/payment/confirm/{voucher_no}', [PaymentVoucherController::class,'confirm'])->name('acc.voucher.payment.confirm');
    Route::post('/accounts/voucher/payment/cancelall/{voucher_no}', [VoucherMasterController::class,'destroy'])->name('acc.voucher.payment.cancelall');
    Route::post('/accounts/voucher/payment/store', [PaymentVoucherController::class,'store'])->name('acc.voucher.payment.store');
    Route::get('/accounts/voucher/payment/show/{voucher_no}', [PaymentVoucherController::class,'show'])->name('acc.voucher.payment.show');
    Route::get('/accounts/voucher/payment/download/{voucher_no}', [PaymentVoucherController::class,'downalodvoucher'])->name('acc.voucher.payment.download');
    Route::get('/accounts/voucher/payment/edit/{id}', [PaymentVoucherController::class,'edit'])->name('acc.voucher.payment.edit');
    Route::get('/accounts/voucher/payment/edit-multiple/{id}', [PaymentVoucherController::class,'editMultiple'])->name('acc.voucher.payment.editMultiple');
    Route::post('/accounts/voucher/payment/destroy/{id}', [PaymentVoucherController::class,'destroy'])->name('acc.voucher.payment.destroy');
    Route::get('/accounts/voucher/payment/voucher/edit/{voucher_no}', function (Request $request){ session(['payment_no'=>request('voucher_no')]);
            return redirect('/accounts/voucher/payment/create');})->name('acc.voucher.payment.voucher.edit');
        Route::get('/accounts/voucher/payment/voucher/edit-multiple/{voucher_no}', function (Request $request){ session(['payment_no'=>request('voucher_no')]);
            return redirect('/accounts/voucher/payment/create-multiple');})->name('acc.voucher.payment.voucher.editMultiple');
    Route::post('/accounts/voucher/payment/update/{id}', [PaymentVoucherController::class,'update'])->name('acc.voucher.payment.update');
    Route::post('/accounts/voucher/payment/voucher/destroy/{voucher_no}', [VoucherMasterController::class,'deleteFullVoucher'])->name('acc.voucher.payment.voucher.destroy');
    Route::post('/accounts/voucher/payment/status/update/{voucher_no}', [PaymentVoucherController::class,'statusupdate'])->name('acc.voucher.payment.status.update');

    //Accounts/voucher/Journal Voucher
    Route::get('/accounts/voucher/journal/',[JournalVoucherController::class,'index'])->name('acc.voucher.journal.view');
    Route::get('/accounts/voucher/journal/create', [JournalVoucherController::class,'create'])->name('acc.voucher.journal.create');
    Route::post('/accounts/voucher/journal/initiate', [VoucherMasterController::class,'store'])->name('acc.voucher.journal.initiate');
    Route::post('/accounts/voucher/journal/mupdate/{voucher_no}', [VoucherMasterController::class,'update'])->name('acc.voucher.journal.mupdate');
    Route::post('/accounts/voucher/journal/confirm/{voucher_no}', [JournalVoucherController::class,'confirm'])->name('acc.voucher.journal.confirm');
    Route::post('/accounts/voucher/journal/cancelall/{voucher_no}', [VoucherMasterController::class,'destroy'])->name('acc.voucher.journal.cancelall');
    Route::post('/accounts/voucher/journal/store', [JournalVoucherController::class,'store'])->name('acc.voucher.journal.store');
    Route::get('/accounts/voucher/journal/show/{voucher_no}', [JournalVoucherController::class,'show'])->name('acc.voucher.journal.show');
    Route::get('/accounts/voucher/journal/download/{voucher_no}', [JournalVoucherController::class,'downalodvoucher'])->name('acc.voucher.journal.download');
    Route::get('/accounts/voucher/journal/edit/{id}', [JournalVoucherController::class,'edit'])->name('acc.voucher.journal.edit');
    Route::post('/accounts/voucher/journal/destroy/{id}', [JournalVoucherController::class,'destroy'])->name('acc.voucher.journal.destroy');
    Route::get('/accounts/voucher/journal/voucher/edit/{voucher_no}', function (Request $request){ session(['payment_no'=>request('voucher_no')]);
            return redirect('/accounts/voucher/journal/create');})->name('acc.voucher.journal.voucher.edit');
        Route::get('/accounts/voucher/journal/voucher/edit-multiple/{voucher_no}', function (Request $request){ session(['payment_no'=>request('voucher_no')]);
            return redirect('/accounts/voucher/journal/create-multiple');})->name('acc.voucher.journal.voucher.editMultiple');
    Route::post('/accounts/voucher/journal/update/{id}', [JournalVoucherController::class,'update'])->name('acc.voucher.journal.update');
    Route::post('/accounts/voucher/journal/voucher/destroy/{voucher_no}', [JournalVoucherController::class,'deleteFullVoucher'])->name('acc.voucher.journal.voucher.destroy');
    Route::post('/accounts/voucher/journal/status/update/{voucher_no}', [JournalVoucherController::class,'statusupdate'])->name('acc.voucher.journal.status.update');




    Route::get('/accounts/selectaccountsreport',function () {return 'This page is under construction';})->name('acc.select.report');
    Route::get('/underconstraction/',function () {return 'This page is under construction';})->name('under.construction');

});

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
use App\Http\Controllers\Accounts\Vouchers\ContraVoucherController;
use App\Http\Controllers\Accounts\Vouchers\ChequePaymentVoucherController;
use App\Http\Controllers\Accounts\COA\COAController;
use App\Http\Controllers\Accounts\Vouchers\VoucherViewController;
use App\Http\Controllers\Accounts\Reports\AccReportsController;

use App\Http\Controllers\Procurement\Vendor\VendorTypeController;
use App\Http\Controllers\Procurement\Vendor\VendorCategoryController;
use App\Http\Controllers\Procurement\Vendor\VendorInfoController;
use App\Http\Controllers\Procurement\workorder\ProPurchaseMasterController;
use App\Http\Controllers\Warehouse\warehouse\WhWarehouseController;
use App\Http\Controllers\Accounts\Products\AccProductGroupController;
use App\Http\Controllers\Accounts\Products\AccProductSubGroupController;
use App\Http\Controllers\Accounts\Products\AccProductsUnitController;
use App\Http\Controllers\Accounts\Products\AccProductItemController;
use App\Http\Controllers\Accounts\Products\AccProductBrandController;
use App\Http\Controllers\Accounts\Products\AccProductTariffMasterController;
use App\Http\Controllers\Procurement\workorder\PurchaseInvoiceController;


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

    //Accounts/product/group
    Route::get('/accounts/product/group/',[AccProductGroupController::class,'index'])->name('acc.product.group.view');
    Route::get('/accounts/product/group/create', [AccProductGroupController::class,'create'])->name('acc.product.group.create');
    Route::post('/accounts/product/group/store', [AccProductGroupController::class,'store'])->name('acc.product.group.store');
    Route::get('/accounts/product/group/edit/{group_id}', [AccProductGroupController::class,'edit'])->name('acc.product.group.edit');
    Route::post('/accounts/product/group/update/{group_id}', [AccProductGroupController::class,'update'])->name('acc.product.group.update');
    Route::post('/accounts/product/group/destroy/{group_id}', [AccProductGroupController::class,'destroy'])->name('acc.product.group.destroy');

    //Accounts/product/sub-group
    Route::get('/accounts/product/sub-group/',[AccProductSubGroupController::class,'index'])->name('acc.product.sub-group.view');
    Route::get('/accounts/product/sub-group/create', [AccProductSubGroupController::class,'create'])->name('acc.product.sub-group.create');
    Route::post('/accounts/product/sub-group/store', [AccProductSubGroupController::class,'store'])->name('acc.product.sub-group.store');
    Route::get('/accounts/product/sub-group/edit/{sub_group_id}', [AccProductSubGroupController::class,'edit'])->name('acc.product.sub-group.edit');
    Route::post('/accounts/product/sub-group/update/{sub_group_id}', [AccProductSubGroupController::class,'update'])->name('acc.product.sub-group.update');
    Route::post('/accounts/product/sub-group/destroy/{sub_group_id}', [AccProductSubGroupController::class,'destroy'])->name('acc.product.sub-group.destroy');

    //Accounts/product/Brand
    Route::get('/accounts/product/brand/',[AccProductBrandController::class,'index'])->name('acc.product.brand.view');
    Route::get('/accounts/product/brand/create', [AccProductBrandController::class,'create'])->name('acc.product.brand.create');
    Route::post('/accounts/product/brand/store', [AccProductBrandController::class,'store'])->name('acc.product.brand.store');
    Route::get('/accounts/product/brand/edit/{brand_id}', [AccProductBrandController::class,'edit'])->name('acc.product.brand.edit');
    Route::post('/accounts/product/brand/update/{brand_id}', [AccProductBrandController::class,'update'])->name('acc.product.brand.update');
    Route::post('/accounts/product/brand/destroy/{brand_id}', [AccProductBrandController::class,'destroy'])->name('acc.product.brand.destroy');

    //Accounts/product/unit management
    Route::get('/accounts/product/unit/',[AccProductsUnitController::class,'index'])->name('acc.product.unit.view');
    Route::get('/accounts/product/unit/create', [AccProductsUnitController::class,'create'])->name('acc.product.unit.create');
    Route::post('/accounts/product/unit/store', [AccProductsUnitController::class,'store'])->name('acc.product.unit.store');
    Route::get('/accounts/product/unit/edit/{unit_id}', [AccProductsUnitController::class,'edit'])->name('acc.product.unit.edit');
    Route::post('/accounts/product/unit/update/{unit_id}', [AccProductsUnitController::class,'update'])->name('acc.product.unit.update');
    Route::post('/accounts/product/unit/destroy/{unit_id}', [AccProductsUnitController::class,'destroy'])->name('acc.product.unit.destroy');

    //Accounts/product/item
    Route::get('/accounts/product/item/',[AccProductItemController::class,'index'])->name('acc.product.item.view');
    Route::get('/accounts/product/item/create', [AccProductItemController::class,'create'])->name('acc.product.item.create');
    Route::post('/accounts/product/item/store', [AccProductItemController::class,'store'])->name('acc.product.item.store');
    Route::get('/accounts/product/item/edit/{item_id}', [AccProductItemController::class,'edit'])->name('acc.product.item.edit');
    Route::post('/accounts/product/item/update/{item_id}', [AccProductItemController::class,'update'])->name('acc.product.item.update');
    Route::post('/accounts/product/item/destroy/{item_id}', [AccProductItemController::class,'destroy'])->name('acc.product.item.destroy');

    //Accounts/product/Tariff Master
    Route::get('/accounts/product/tariff-master/',[AccProductTariffMasterController::class,'index'])->name('acc.product.tariff-master.view');
    Route::get('/accounts/product/tariff-master/create', [AccProductTariffMasterController::class,'create'])->name('acc.product.tariff-master.create');
    Route::post('/accounts/product/tariff-master/store', [AccProductTariffMasterController::class,'store'])->name('acc.product.tariff-master.store');
    Route::get('/accounts/product/tariff-master/edit/{unit_id}', [AccProductTariffMasterController::class,'edit'])->name('acc.product.tariff-master.edit');
    Route::post('/accounts/product/tariff-master/update/{unit_id}', [AccProductTariffMasterController::class,'update'])->name('acc.product.tariff-master.update');
    Route::post('/accounts/product/tariff-master/destroy/{unit_id}', [AccProductTariffMasterController::class,'destroy'])->name('acc.product.tariff-master.destroy');

    //Accounts/voucher/receipt voucher
    Route::get('/accounts/voucher/receipt/',[ReceiptVoucherController::class,'index'])->name('acc.voucher.receipt.view');
    Route::get('/accounts/voucher/receipt/create', [ReceiptVoucherController::class,'create'])->name('acc.voucher.receipt.create');
    Route::get('/accounts/voucher/receipt/create-multiple', [ReceiptVoucherController::class,'createMultiple'])->name('acc.voucher.receipt.multiple.create');
    Route::post('/accounts/voucher/receipt/initiate', [VoucherMasterController::class,'store'])->name('acc.voucher.receipt.initiate');
    Route::post('/accounts/voucher/receipt/mupdate/{voucher_no}', [VoucherMasterController::class,'update'])->name('acc.voucher.receipt.mupdate');
    Route::post('/accounts/voucher/receipt/confirm/{voucher_no}', [ReceiptVoucherController::class,'confirm'])->name('acc.voucher.receipt.confirm');
    Route::post('/accounts/voucher/receipt/cancelall/{voucher_no}', [VoucherMasterController::class,'destroy'])->name('acc.voucher.receipt.cancelall');
    Route::get('/accounts/voucher/receipt/cancelall/{voucher_no}', [VoucherMasterController::class,'destroy'])->name('acc.voucher.receipt.cancelall');
    Route::post('/accounts/voucher/receipt/store', [ReceiptVoucherController::class,'store'])->name('acc.voucher.receipt.store');
    Route::get('/accounts/voucher/receipt/show/{voucher_no}', [ReceiptVoucherController::class,'show'])->name('acc.voucher.receipt.show');
    Route::get('/accounts/voucher/receipt/print/{voucher_no}', [ReceiptVoucherController::class,'voucherPrint'])->name('acc.voucher.receipt.print');
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
    Route::get('/accounts/voucher/payment/cancelall/{voucher_no}', [VoucherMasterController::class,'destroy'])->name('acc.voucher.payment.cancelall');
    Route::post('/accounts/voucher/payment/store', [PaymentVoucherController::class,'store'])->name('acc.voucher.payment.store');
    Route::get('/accounts/voucher/payment/show/{voucher_no}', [PaymentVoucherController::class,'show'])->name('acc.voucher.payment.show');
    Route::get('/accounts/voucher/payment/print/{voucher_no}', [PaymentVoucherController::class,'voucherPrint'])->name('acc.voucher.payment.print');
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
    Route::get('/accounts/voucher/journal/cancelall/{voucher_no}', [VoucherMasterController::class,'destroy'])->name('acc.voucher.journal.cancelall');
    Route::post('/accounts/voucher/journal/store', [JournalVoucherController::class,'store'])->name('acc.voucher.journal.store');
    Route::get('/accounts/voucher/journal/show/{voucher_no}', [JournalVoucherController::class,'show'])->name('acc.voucher.journal.show');
    Route::get('/accounts/voucher/journal/print/{voucher_no}', [JournalVoucherController::class,'voucherPrint'])->name('acc.voucher.journal.print');
    Route::get('/accounts/voucher/journal/download/{voucher_no}', [JournalVoucherController::class,'downalodvoucher'])->name('acc.voucher.journal.download');
    Route::get('/accounts/voucher/journal/edit/{id}', [JournalVoucherController::class,'edit'])->name('acc.voucher.journal.edit');
    Route::post('/accounts/voucher/journal/destroy/{id}', [JournalVoucherController::class,'destroy'])->name('acc.voucher.journal.destroy');
    Route::get('/accounts/voucher/journal/voucher/edit/{voucher_no}', function (Request $request){ session(['payment_no'=>request('voucher_no')]);
            return redirect('/accounts/voucher/journal/create');})->name('acc.voucher.journal.voucher.edit');
        Route::get('/accounts/voucher/journal/voucher/edit-multiple/{voucher_no}', function (Request $request){ session(['payment_no'=>request('voucher_no')]);
            return redirect('/accounts/voucher/journal/create-multiple');})->name('acc.voucher.journal.voucher.editMultiple');
    Route::post('/accounts/voucher/journal/update/{id}', [JournalVoucherController::class,'update'])->name('acc.voucher.journal.update');
    Route::post('/accounts/voucher/journal/voucher/destroy/{voucher_no}', [VoucherMasterController::class,'deleteFullVoucher'])->name('acc.voucher.journal.voucher.destroy');
    Route::post('/accounts/voucher/journal/status/update/{voucher_no}', [JournalVoucherController::class,'statusupdate'])->name('acc.voucher.journal.status.update');

    //Accounts/voucher/Contra Voucher
    Route::get('/accounts/voucher/contra/',[ContraVoucherController::class,'index'])->name('acc.voucher.contra.view');
    Route::get('/accounts/voucher/contra/create', [ContraVoucherController::class,'create'])->name('acc.voucher.contra.create');
    Route::post('/accounts/voucher/contra/initiate', [VoucherMasterController::class,'store'])->name('acc.voucher.contra.initiate');
    Route::post('/accounts/voucher/contra/mupdate/{voucher_no}', [VoucherMasterController::class,'update'])->name('acc.voucher.contra.mupdate');
    Route::post('/accounts/voucher/contra/confirm/{voucher_no}', [ContraVoucherController::class,'confirm'])->name('acc.voucher.contra.confirm');
    Route::post('/accounts/voucher/contra/cancelall/{voucher_no}', [VoucherMasterController::class,'destroy'])->name('acc.voucher.contra.cancelall');
    Route::get('/accounts/voucher/contra/cancelall/{voucher_no}', [VoucherMasterController::class,'destroy'])->name('acc.voucher.contra.cancelall');
    Route::post('/accounts/voucher/contra/store', [ContraVoucherController::class,'store'])->name('acc.voucher.contra.store');
    Route::get('/accounts/voucher/contra/show/{voucher_no}', [ContraVoucherController::class,'show'])->name('acc.voucher.contra.show');
    Route::get('/accounts/voucher/contra/print/{voucher_no}', [ContraVoucherController::class,'voucherPrint'])->name('acc.voucher.contra.print');
    Route::get('/accounts/voucher/contra/download/{voucher_no}', [ContraVoucherController::class,'downalodvoucher'])->name('acc.voucher.contra.download');
    Route::get('/accounts/voucher/contra/edit/{id}', [ContraVoucherController::class,'edit'])->name('acc.voucher.contra.edit');
    Route::post('/accounts/voucher/contra/destroy/{id}', [ContraVoucherController::class,'destroy'])->name('acc.voucher.contra.destroy');
    Route::get('/accounts/voucher/contra/voucher/edit/{voucher_no}', function (Request $request){ session(['contra_no'=>request('voucher_no')]);
            return redirect('/accounts/voucher/contra/create');})->name('acc.voucher.contra.voucher.edit');
        Route::get('/accounts/voucher/contra/voucher/edit-multiple/{voucher_no}', function (Request $request){ session(['contra_no'=>request('voucher_no')]);
            return redirect('/accounts/voucher/contra/create-multiple');})->name('acc.voucher.contra.voucher.editMultiple');
    Route::post('/accounts/voucher/contra/update/{id}', [ContraVoucherController::class,'update'])->name('acc.voucher.contra.update');
    Route::post('/accounts/voucher/contra/voucher/destroy/{voucher_no}', [VoucherMasterController::class,'deleteFullVoucher'])->name('acc.voucher.contra.voucher.destroy');
    Route::post('/accounts/voucher/contra/status/update/{voucher_no}', [ContraVoucherController::class,'statusupdate'])->name('acc.voucher.contra.status.update');

    //Accounts/voucher/Cheque Payment Voucher
    Route::get('/accounts/voucher/chequepayment/',[ChequePaymentVoucherController::class,'index'])->name('acc.voucher.chequepayment.view');
    Route::get('/accounts/voucher/chequepayment/create', [ChequePaymentVoucherController::class,'create'])->name('acc.voucher.chequepayment.create');
    Route::post('/accounts/voucher/chequepayment/initiate', [VoucherMasterController::class,'store'])->name('acc.voucher.chequepayment.initiate');
    Route::post('/accounts/voucher/chequepayment/mupdate/{voucher_no}', [VoucherMasterController::class,'update'])->name('acc.voucher.chequepayment.mupdate');
    Route::post('/accounts/voucher/chequepayment/confirm/{voucher_no}', [ChequePaymentVoucherController::class,'confirm'])->name('acc.voucher.chequepayment.confirm');
    Route::post('/accounts/voucher/chequepayment/cancelall/{voucher_no}', [VoucherMasterController::class,'destroy'])->name('acc.voucher.chequepayment.cancelall');
    Route::get('/accounts/voucher/chequepayment/cancelall/{voucher_no}', [VoucherMasterController::class,'destroy'])->name('acc.voucher.chequepayment.cancelall');
    Route::post('/accounts/voucher/chequepayment/store', [ChequePaymentVoucherController::class,'store'])->name('acc.voucher.chequepayment.store');
    Route::get('/accounts/voucher/chequepayment/show/{voucher_no}', [ChequePaymentVoucherController::class,'show'])->name('acc.voucher.chequepayment.show');
    Route::get('/accounts/voucher/chequepayment/download/{voucher_no}', [ChequePaymentVoucherController::class,'downalodvoucher'])->name('acc.voucher.chequepayment.download');
    Route::get('/accounts/voucher/chequepayment/edit/{id}', [ChequePaymentVoucherController::class,'edit'])->name('acc.voucher.chequepayment.edit');
    Route::post('/accounts/voucher/chequepayment/destroy/{id}', [ChequePaymentVoucherController::class,'destroy'])->name('acc.voucher.chequepayment.destroy');
    Route::get('/accounts/voucher/chequepayment/voucher/edit/{voucher_no}', function (Request $request){ session(['contra_no'=>request('voucher_no')]);
            return redirect('/accounts/voucher/chequepayment/create');})->name('acc.voucher.chequepayment.voucher.edit');
        Route::get('/accounts/voucher/chequepayment/voucher/edit-multiple/{voucher_no}', function (Request $request){ session(['contra_no'=>request('voucher_no')]);
            return redirect('/accounts/voucher/chequepayment/create-multiple');})->name('acc.voucher.chequepayment.voucher.editMultiple');
    Route::post('/accounts/voucher/chequepayment/update/{id}', [ChequePaymentVoucherController::class,'update'])->name('acc.voucher.chequepayment.update');
    Route::post('/accounts/voucher/chequepayment/voucher/destroy/{voucher_no}', [VoucherMasterController::class,'deleteFullVoucher'])->name('acc.voucher.chequepayment.voucher.destroy');
    Route::post('/accounts/voucher/chequepayment/status/update/{voucher_no}', [ChequePaymentVoucherController::class,'statusupdate'])->name('acc.voucher.chequepayment.status.update');
    //voucher view
    Route::get('/accounts/voucher/view/',[VoucherViewController::class,'index'])->name('acc.voucher.view');
    Route::post('/accounts/voucher/view/',[VoucherViewController::class,'filterVouchers'])->name('acc.voucher.filter');
    // Accounts Reports
    Route::get('/accounts/select-accounts-report',[AccReportsController::class,'index'])->name('acc.select.report');
    Route::get('/accounts/select-accounts-report/report_id/{report_id}',[AccReportsController::class,'select'])->name('acc.selected.report');
    Route::post('/accounts/generatereport/report_id/{report_id}',[AccReportsController::class,'generateReport'])->name('acc.generatereport');


    //Procurement/vendor/type
    Route::get('/procurement/vendor/type/',[VendorTypeController::class,'index'])->name('pro.vendor.type.view');
    Route::get('/procurement/vendor/type/create', [VendorTypeController::class,'create'])->name('pro.vendor.type.create');
    Route::post('/procurement/vendor/type/store', [VendorTypeController::class,'store'])->name('pro.vendor.type.store');
    Route::get('/procurement/vendor/type/edit/{id}', [VendorTypeController::class,'edit'])->name('pro.vendor.type.edit');
    Route::post('/procurement/vendor/type/update/{id}', [VendorTypeController::class,'update'])->name('pro.vendor.type.update');
    Route::post('/procurement/vendor/type/destroy/{id}', [VendorTypeController::class,'destroy'])->name('pro.vendor.type.destroy');
//Procurement/vendor/category
    Route::get('/procurement/vendor/category/',[VendorCategoryController::class,'index'])->name('pro.vendor.category.view');
    Route::get('/procurement/vendor/category/create', [VendorCategoryController::class,'create'])->name('pro.vendor.category.create');
    Route::post('/procurement/vendor/category/store', [VendorCategoryController::class,'store'])->name('pro.vendor.category.store');
    Route::get('/procurement/vendor/category/edit/{id}', [VendorCategoryController::class,'edit'])->name('pro.vendor.category.edit');
    Route::post('/procurement/vendor/category/update/{id}', [VendorCategoryController::class,'update'])->name('pro.vendor.category.update');
    Route::post('/procurement/vendor/category/destroy/{id}', [VendorCategoryController::class,'destroy'])->name('pro.vendor.category.destroy');
//Procurement/vendor/vendor Info
    Route::get('/procurement/vendor/vendor-info/',[VendorInfoController::class,'index'])->name('pro.vendor.vendorinfo.view');
    Route::get('/procurement/vendor/vendor-info/create', [VendorInfoController::class,'create'])->name('pro.vendor.vendorinfo.create');
    Route::post('/procurement/vendor/vendor-info/store', [VendorInfoController::class,'store'])->name('pro.vendor.vendorinfo.store');
    Route::get('/procurement/vendor/vendor-info/edit/{id}', [VendorInfoController::class,'edit'])->name('pro.vendor.vendorinfo.edit');
    Route::post('/procurement/vendor/vendor-info/update/{id}', [VendorInfoController::class,'update'])->name('pro.vendor.vendorinfo.update');
    Route::post('/procurement/vendor/vendor-info/destroy/{id}', [VendorInfoController::class,'destroy'])->name('pro.vendor.vendorinfo.destroy');

    //Procurement/Work Order or purchase
    Route::get('/procurement/work-order/create',[ProPurchaseMasterController::class,'create'])->name('pro.workorder.create');
    Route::get('/procurement/direct-purchase/create', [ProPurchaseMasterController::class,'directPurchaseCreate'])->name('pro.direct-purchase.create');
    Route::post('/procurement/work-order/initiate', [ProPurchaseMasterController::class,'store'])->name('pro.workorder.initiate');
    Route::get('/procurement/work-order/cancel/{po_no}', [ProPurchaseMasterController::class,'destroy'])->name('pro.workorder.cancel');
    Route::post('/procurement/work-order/cancelall/{po_no}', [ProPurchaseMasterController::class,'destroyall'])->name('pro.workorder.cancelall');
    Route::post('/procurement/work-order/confirm/{po_no}', [ProPurchaseMasterController::class,'confirm'])->name('pro.workorder.confirm');

    Route::post('/procurement/work-order/product/store', [PurchaseInvoiceController::class,'store'])->name('pro.workorder.product.store');
    Route::get('/procurement/work-order/product/edit/{id}', [PurchaseInvoiceController::class,'edit'])->name('pro.workorder.product.edit');
    Route::post('/procurement/work-order/product/update/{id}', [PurchaseInvoiceController::class,'update'])->name('pro.workorder.product.update');
    Route::post('/procurement/work-order/product/destroy/{id}', [PurchaseInvoiceController::class,'destroy'])->name('pro.workorder.product.destroy');


    Route::post('/procurement/workorder/store', [ProPurchaseMasterController::class,'store'])->name('pro.vendor.vendorinfo.store');
    Route::get('/procurement/workorder/edit/{id}', [ProPurchaseMasterController::class,'edit'])->name('pro.vendor.vendorinfos.edit');
    Route::post('/procurement/workorder/update/{po_no}', [ProPurchaseMasterController::class,'update'])->name('pro.workorder.update');
    Route::post('/procurement/workorder/destroy/{id}', [ProPurchaseMasterController::class,'destroy'])->name('pro.vendor.vendorinfos.destroy');

    //warehouse/create warehouse
    Route::get('/warehouse/warehouse/',[WhWarehouseController::class,'index'])->name('wh.warehouse.view');
    Route::get('/warehouse/warehouse/create',[WhWarehouseController::class,'create'])->name('wh.warehouse.create');
    Route::post('/warehouse/warehouse/store', [WhWarehouseController::class,'store'])->name('wh.warehouse.store');
    Route::get('/warehouse/warehouse/edit/{warehouse_id}', [WhWarehouseController::class,'edit'])->name('wh.warehouse.edit');
    Route::post('/warehouse/warehouse/update/{warehouse_id}', [WhWarehouseController::class,'update'])->name('wh.warehouse.update');
    Route::post('/warehouse/warehouse/destroy/{warehouse_id}', [WhWarehouseController::class,'destroy'])->name('wh.warehouse.destroy');

    Route::get('/underconstraction/',function () {return 'This page is under construction';})->name('under.construction');

});

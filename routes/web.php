<?php

use App\Http\Controllers\Accounts\COA\ClassController;
use App\Http\Controllers\Accounts\COA\COAController;
use App\Http\Controllers\Accounts\COA\CostCategoryController;
use App\Http\Controllers\Accounts\COA\CostCenterController;
use App\Http\Controllers\Accounts\COA\LedgerController;
use App\Http\Controllers\Accounts\COA\LedgerGroupController;
use App\Http\Controllers\Accounts\COA\SubClassController;
use App\Http\Controllers\Accounts\COA\SubLedgerController;
use App\Http\Controllers\Accounts\COA\SubSubLedgerController;
use App\Http\Controllers\Accounts\Products\AccProductBrandController;
use App\Http\Controllers\Accounts\Products\AccProductGroupController;
use App\Http\Controllers\Accounts\Products\AccProductItemController;
use App\Http\Controllers\Accounts\Products\AccProductSubGroupController;
use App\Http\Controllers\Accounts\Products\AccProductsUnitController;
use App\Http\Controllers\Accounts\Products\AccProductTariffMasterController;
use App\Http\Controllers\Accounts\Reports\AccReportsController;
use App\Http\Controllers\Accounts\Vouchers\ChequePaymentVoucherController;
use App\Http\Controllers\Accounts\Vouchers\ContraVoucherController;
use App\Http\Controllers\Accounts\Vouchers\JournalVoucherController;
use App\Http\Controllers\Accounts\Vouchers\PaymentVoucherController;
use App\Http\Controllers\Accounts\Vouchers\ReceiptVoucherController;
use App\Http\Controllers\Accounts\Vouchers\VoucherMasterController;
use App\Http\Controllers\Accounts\Vouchers\VoucherViewController;
use App\Http\Controllers\Developer\Builder\CompanyController;
use App\Http\Controllers\Developer\Builder\ERPUserController;
use App\Http\Controllers\Developer\Builder\GroupController;
use App\Http\Controllers\Developer\Builder\MainMenuController;
use App\Http\Controllers\Developer\Builder\ModulesController;
use App\Http\Controllers\Developer\Builder\SubMenuController;
use App\Http\Controllers\Developer\Builder\DevReportGroupController;
use App\Http\Controllers\Developer\UsageControl\ERPUCController;
use App\Http\Controllers\Developer\Builder\DevBuildOtherController;
use App\Http\Controllers\employeeAccess\approval\EaApprovalLeaveController;
use App\Http\Controllers\employeeAccess\attendance\EaEarlyLeaveApplicationController;
use App\Http\Controllers\employeeAccess\attendance\EALateAttendanceApplicationController;
use App\Http\Controllers\employeeAccess\attendance\EALeaveApplicationController;
use App\Http\Controllers\employeeAccess\attendance\EaOutDoorDutyController;
use App\Http\Controllers\employeeAccess\recommendation\EaRecommendationEarlyLeaveController;
use App\Http\Controllers\employeeAccess\recommendation\EaRecommendationLeaveController;
use App\Http\Controllers\employeeAccess\responsible\EaResponsibleForEarlyLeaveController;
use App\Http\Controllers\employeeAccess\responsible\EaResponsibleForLeaveController;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\HRM\attendance\HrmAttendanceLeaveController;
use App\Http\Controllers\HRM\employee\EmployeeController;
use App\Http\Controllers\HRM\payroll\HrmPayrollSalaryController;
use App\Http\Controllers\HRM\payroll\HrmPayrollSalaryScaleController;
use App\Http\Controllers\HRM\setup\ActionTypeController;
use App\Http\Controllers\HRM\setup\BloodController;
use App\Http\Controllers\HRM\setup\DemotionReasonController;
use App\Http\Controllers\HRM\setup\DepartmentController;
use App\Http\Controllers\HRM\setup\DesignationController;
use App\Http\Controllers\HRM\setup\EducationalQualificationController;
use App\Http\Controllers\HRM\setup\EduExamTitleController;
use App\Http\Controllers\HRM\setup\EduSubjectController;
use App\Http\Controllers\HRM\setup\EmploymentTypeController;
use App\Http\Controllers\HRM\setup\GradeController;
use App\Http\Controllers\HRM\setup\HolidaysController;
use App\Http\Controllers\HRM\setup\HrmOrganizationController;
use App\Http\Controllers\HRM\setup\HrmProfessionController;
use App\Http\Controllers\HRM\setup\HrmRelationController;
use App\Http\Controllers\HRM\setup\HrmUniversityController;
use App\Http\Controllers\HRM\setup\JobExperienceController;
use App\Http\Controllers\HRM\setup\JobLocationController;
use App\Http\Controllers\HRM\setup\LeaveTypeController;
use App\Http\Controllers\HRM\setup\ReligionController;
use App\Http\Controllers\HRM\setup\ShiftController;
use App\Http\Controllers\HRM\setup\TravelNatureController;
use App\Http\Controllers\HRM\setup\TravelScopeController;
use App\Http\Controllers\MIS\PermissionMatrix\MISPMCompanyController;
use App\Http\Controllers\MIS\PermissionMatrix\MISPMMainMenuController;
use App\Http\Controllers\MIS\PermissionMatrix\MISPMModuleController;
use App\Http\Controllers\MIS\PermissionMatrix\MISPMReportController;
use App\Http\Controllers\MIS\PermissionMatrix\MISPMSubMenuController;
use App\Http\Controllers\MIS\PermissionMatrix\MISPMWarehouseController;
use App\Http\Controllers\MIS\PermissionMatrix\MISPMOtherOptionsController;
use App\Http\Controllers\MIS\User\MISCreateUserController;
use App\Http\Controllers\Procurement\Vendor\VendorCategoryController;
use App\Http\Controllers\Procurement\Vendor\VendorInfoController;
use App\Http\Controllers\Procurement\Vendor\VendorTypeController;
use App\Http\Controllers\Procurement\workorder\ProPurchaseMasterController;
use App\Http\Controllers\Procurement\workorder\PurchaseInvoiceController;
use App\Http\Controllers\Sales\Dealer\CreditLimitController;
use App\Http\Controllers\Sales\Dealer\DealerCategoryController;
use App\Http\Controllers\Sales\Dealer\DealerController;
use App\Http\Controllers\Sales\Dealer\DealerTypeController;
use App\Http\Controllers\Sales\DistributionSetup\Area\AreaController;
use App\Http\Controllers\Sales\DistributionSetup\Region\RegionController;
use App\Http\Controllers\Sales\DistributionSetup\Territory\TerritoryController;
use App\Http\Controllers\Sales\DistributionSetup\Town\TownController;
use App\Http\Controllers\Sales\TradeScheme\TradeSchemeController;
use App\Http\Controllers\Warehouse\warehouse\WhWarehouseController;
use Illuminate\Support\Facades\Route;


// home
Route::get('/', [HomeController::class,'index']);

    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard',[HomeController::class,'home'])->name('dashboard');
    Route::get('/dashboard/module_id/{module_id}', function (Request $request){ session(['module_id'=>request('module_id')]);
        return redirect('/dashboard');
    });

    //Developer/Group
    Route::get('/developer/group/',[GroupController::class,'index'])->name('dev.group.view');
    Route::get('/developer/group/create', [GroupController::class,'create'])->name('dev.group.create');
    Route::post('/developer/group/store', [GroupController::class,'store'])->name('dev.group.store');
    Route::get('/developer/group/show/{group_id}', [GroupController::class,'show'])->name('dev.group.show');
    Route::get('/developer/group/edit/{group_id}', [GroupController::class,'edit'])->name('dev.group.edit');
    Route::post('/developer/group/update/{group_id}', [GroupController::class,'update'])->name('dev.group.update');
    Route::post('developer/group/destroy/{group_id}', [GroupController::class,'destroy'])->name('dev.group.destroy');

    //Developer/Company
    Route::get('/developer/company/',[CompanyController::class,'index'])->name('dev.company.view');
    Route::get('/developer/company/create', [CompanyController::class,'create'])->name('dev.company.create');
    Route::post('/developer/company/store', [CompanyController::class,'store'])->name('dev.company.store');
    Route::get('/developer/company/show/{id}', [CompanyController::class,'show'])->name('dev.company.show');
    Route::get('/developer/company/edit/{id}', [CompanyController::class,'edit'])->name('dev.company.edit');
    Route::post('/developer/company/update/{id}', [CompanyController::class,'update'])->name('dev.company.update');
    Route::post('developer/company/destroy/{id}', [CompanyController::class,'destroy'])->name('dev.company.destroy');

    // MIS/ User / Create User
    Route::get('/developer/user/create-user/',[ERPUserController::class,'index'])->name('dev.user.erpUser.view');
    Route::get('/developer/user/create-user/create/',[ERPUserController::class,'create'])->name('dev.user.createErpUser.create');
    Route::post('/developer/user/create-user/store',[ERPUserController::class,'store'])->name('dev.user.createErpUser.store');
    Route::get('/developer/user/create-user/edit/{id}',[ERPUserController::class,'edit'])->name('dev.user.createUser.edit');
    Route::get('/developer/user/create-user/show/{id}',[ERPUserController::class,'show'])->name('dev.user.createUser.show');
    Route::post('/developer/user/create-user/update/{id}',[ERPUserController::class,'update'])->name('dev.user.createUser.update');
    Route::post('/developer/user/create-user/destroy/{id}',[ERPUserController::class,'destroy'])->name('dev.user.createUser.destroy');


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
    Route::get('/developer/sub-menu/show/{sub_menu_id}', [SubMenuController::class,'show'])->name('dev.sub-menu.show');
    Route::get('/developer/sub-menu/edit/{sub_menu_id}', [SubMenuController::class,'edit'])->name('dev.sub-menu.edit');
    Route::post('/developer/sub-menu/update/{sub_menu_id}', [SubMenuController::class,'update'])->name('dev.sub-menu.update');
    Route::post('developer/sub-menu/destroy/{sub_menu_id}', [SubMenuController::class,'destroy'])->name('dev.sub-menu.destroy');

    //Developer/Builder / Other
    Route::get('/developer/builder/other',[DevBuildOtherController::class,'index'])->name('dev.builder.other');
    Route::get('/developer/builder/other/create', [DevBuildOtherController::class,'create'])->name('dev.builder.other.create');
    Route::post('/developer/builder/other/store', [DevBuildOtherController::class,'store'])->name('dev.builder.other.store');
    Route::get('/developer/builder/other/edit/{id}', [DevBuildOtherController::class,'edit'])->name('dev.builder.other.edit');
    Route::post('/developer/builder/other/update/{id}', [DevBuildOtherController::class,'update'])->name('dev.builder.other.update');
    Route::post('developer/builder/other/destroy/{id}', [DevBuildOtherController::class,'destroy'])->name('dev.builder.other.destroy');

    //Developer/Report Group Level
    Route::get('/developer/builder/report-group-labels/',[DevReportGroupController::class,'index'])->name('dev.reportGroupLabels.view');
    Route::get('/developer/builder/report-group-labels/create', [DevReportGroupController::class,'create'])->name('dev.reportGroupLabels.create');
    Route::post('/developer/builder/report-group-labels/store', [DevReportGroupController::class,'store'])->name('dev.reportGroupLabels.store');
    Route::get('/developer/builder/report-group-labels/show/{id}', [DevReportGroupController::class,'show'])->name('dev.reportGroupLabels.show');
    Route::get('/developer/builder/report-group-labels/edit/{id}', [DevReportGroupController::class,'edit'])->name('dev.reportGroupLabels.edit');
    Route::post('/developer/builder/report-group-labels/update/{id}', [DevReportGroupController::class,'update'])->name('dev.reportGroupLabels.update');
    Route::post('developer/builder/report-group-labels/destroy/{id}', [DevReportGroupController::class,'destroy'])->name('dev.reportGroupLabels.destroy');

    //Developer/Reports
    Route::get('/developer/builder/report/',[SubMenuController::class,'index'])->name('dev.builder.report.view');
    Route::get('/developer/builder/report/create', [SubMenuController::class,'create'])->name('dev.builder.report.create');
    Route::post('/developer/builder/report/store', [SubMenuController::class,'store'])->name('dev.builder.report.store');
    Route::get('/developer/builder/report/show/{sub_menu_id}', [SubMenuController::class,'show'])->name('dev.builder.report.show');
    Route::get('/developer/builder/report/edit/{sub_menu_id}', [SubMenuController::class,'edit'])->name('dev.builder.report.edit');
    Route::post('/developer/builder/report/update/{sub_menu_id}', [SubMenuController::class,'update'])->name('dev.builder.report.update');
    Route::post('developer/builder/report/destroy/{sub_menu_id}', [SubMenuController::class,'destroy'])->name('dev.builder.report.destroy');

    //Developer/Reports
    Route::get('/developer/usage-control/meta/',[ERPUCController::class,'index'])->name('dev.usageControl.meta.view');
    Route::get('/developer/usage-control/meta/create', [ERPUCController::class,'create'])->name('dev.usageControl.meta.create');
    Route::post('/developer/usage-control/meta/store', [ERPUCController::class,'store'])->name('dev.usageControl.meta.store');
    Route::get('/developer/usage-control/meta/show/{id}', [ERPUCController::class,'show'])->name('dev.usageControl.meta.show');
    Route::get('/developer/usage-control/meta/edit/{id}', [ERPUCController::class,'edit'])->name('dev.usageControl.meta.edit');
    Route::post('/developer/usage-control/meta/update/{id}', [ERPUCController::class,'update'])->name('dev.usageControl.meta.update');
    Route::post('developer/usage-control/meta/destroy/{id}', [ERPUCController::class,'destroy'])->name('dev.usageControl.meta.destroy');

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
    Route::get('/accounts/voucher/receipt/delete_attachment_while_edit/{id}', [ReceiptVoucherController::class,'deleteAttachmentReceiptVoucher'])->name('acc.voucher.receipt.deleteAttachmentReceiptVoucher');
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
    Route::get('/accounts/voucher/payment/delete_attachment_while_edit/{id}', [PaymentVoucherController::class,'deleteAttachmentPaymentVoucher'])->name('acc.voucher.payment.deleteAttachmentPaymentVoucher');
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
    Route::get('/procurement/work-order/edit/{po_no}', function (Request $request){ session(['po_no'=>request('po_no')]);
        return redirect('/procurement/direct-purchase/create');})->name('pro.workorder.edit');
    Route::post('/procurement/work-order/update/{po_no}', [ProPurchaseMasterController::class,'update'])->name('pro.workorder.dupdate');
    Route::get('/procurement/work-order/cancel/{po_no}', [ProPurchaseMasterController::class,'destroy'])->name('pro.workorder.cancel');
    Route::post('/procurement/work-order/cancelall/{po_no}', [ProPurchaseMasterController::class,'destroyall'])->name('pro.workorder.cancelall');
    Route::post('/procurement/work-order/confirm/{po_no}', [ProPurchaseMasterController::class,'confirm'])->name('pro.workorder.confirm');

    Route::post('/procurement/work-order/product/store', [PurchaseInvoiceController::class,'store'])->name('pro.workorder.product.store');
    Route::get('/procurement/work-order/product/edit/{id}', [PurchaseInvoiceController::class,'edit'])->name('pro.workorder.product.edit');
    Route::post('/procurement/work-order/product/update/{id}', [PurchaseInvoiceController::class,'update'])->name('pro.workorder.product.update');
    Route::post('/procurement/work-order/product/destroy/{id}', [PurchaseInvoiceController::class,'destroy'])->name('pro.workorder.product.destroy');

    // procurement/work-order/view
    Route::get('/procurement/work-order/view', [ProPurchaseMasterController::class,'index'])->name('pro.workorder.view');
    Route::post('/procurement/work-order/view',[ProPurchaseMasterController::class,'filterWorkOrder'])->name('pro.workorder.filter');
    Route::get('/procurement/work-order/show/{po_no}', [ProPurchaseMasterController::class,'show'])->name('pro.workorder.show');
    Route::get('/procurement/work-order/print/{po_no}', [ProPurchaseMasterController::class,'voucherPrint'])->name('pro.workorder.print');
    Route::get('/procurement/work-order/download/{po_no}', [ProPurchaseMasterController::class,'downalodvoucher'])->name('pro.workorder.download');
    Route::get('/procurement/work-order/destroy/{po_no}', [ProPurchaseMasterController::class,'downalodvoucher'])->name('pro.workorder.destroy');


    //warehouse/create warehouse
    Route::get('/warehouse/warehouse/',[WhWarehouseController::class,'index'])->name('wh.warehouse.view');
    Route::get('/warehouse/warehouse/create',[WhWarehouseController::class,'create'])->name('wh.warehouse.create');
    Route::post('/warehouse/warehouse/store', [WhWarehouseController::class,'store'])->name('wh.warehouse.store');
    Route::get('/warehouse/warehouse/edit/{warehouse_id}', [WhWarehouseController::class,'edit'])->name('wh.warehouse.edit');
    Route::post('/warehouse/warehouse/update/{warehouse_id}', [WhWarehouseController::class,'update'])->name('wh.warehouse.update');
    Route::post('/warehouse/warehouse/destroy/{warehouse_id}', [WhWarehouseController::class,'destroy'])->name('wh.warehouse.destroy');

    //sales/distributor-setup/region
    Route::get('/sales/distribution-setup/region/',[RegionController::class,'index'])->name('sales.ds.region.view');
    Route::get('/sales/distribution-setup/region/create',[RegionController::class,'create'])->name('sales.ds.region.create');
    Route::post('/sales/distribution-setup/region/store', [RegionController::class,'store'])->name('sales.ds.region.store');
    Route::get('/sales/distribution-setup/region/edit/{region_id}', [RegionController::class,'edit'])->name('sales.ds.region.edit');
    Route::post('/sales/distribution-setup/region/update/{region_id}', [RegionController::class,'update'])->name('sales.ds.region.update');
    Route::post('/sales/distribution-setup/region/destroy/{region_id}', [RegionController::class,'destroy'])->name('sales.ds.region.destroy');

    //sales/distributor-setup/Area
    Route::get('/sales/distribution-setup/area/',[AreaController::class,'index'])->name('sales.ds.area.view');
    Route::get('/sales/distribution-setup/area/create',[AreaController::class,'create'])->name('sales.ds.area.create');
    Route::post('/sales/distribution-setup/area/store', [AreaController::class,'store'])->name('sales.ds.area.store');
    Route::get('/sales/distribution-setup/area/edit/{area_id}', [AreaController::class,'edit'])->name('sales.ds.area.edit');
    Route::post('/sales/distribution-setup/area/update/{area_id}', [AreaController::class,'update'])->name('sales.ds.area.update');
    Route::post('/sales/distribution-setup/area/destroy/{area_id}', [AreaController::class,'destroy'])->name('sales.ds.area.destroy');

    //sales/distributor-setup/Territory
    Route::get('/sales/distribution-setup/territory/',[TerritoryController::class,'index'])->name('sales.ds.territory.view');
    Route::get('/sales/distribution-setup/territory/create',[TerritoryController::class,'create'])->name('sales.ds.territory.create');
    Route::post('/sales/distribution-setup/territory/store', [TerritoryController::class,'store'])->name('sales.ds.territory.store');
    Route::get('/sales/distribution-setup/territory/edit/{territory_id}', [TerritoryController::class,'edit'])->name('sales.ds.territory.edit');
    Route::post('/sales/distribution-setup/territory/update/{territory_id}', [TerritoryController::class,'update'])->name('sales.ds.territory.update');
    Route::post('/sales/distribution-setup/territory/destroy/{territory_id}', [TerritoryController::class,'destroy'])->name('sales.ds.territory.destroy');

    //sales/distributor-setup/Town
    Route::get('/sales/distribution-setup/town/',[TownController::class,'index'])->name('sales.ds.town.view');
    Route::get('/sales/distribution-setup/town/create',[TownController::class,'create'])->name('sales.ds.town.create');
    Route::post('/sales/distribution-setup/town/store', [TownController::class,'store'])->name('sales.ds.town.store');
    Route::get('/sales/distribution-setup/town/edit/{town_id}', [TownController::class,'edit'])->name('sales.ds.town.edit');
    Route::post('/sales/distribution-setup/town/update/{town_id}', [TownController::class,'update'])->name('sales.ds.town.update');
    Route::post('/sales/distribution-setup/town/destroy/{town_id}', [TownController::class,'destroy'])->name('sales.ds.town.destroy');

    //sales/Dealer Category
    Route::get('/sales/dealer/category/',[DealerCategoryController::class,'index'])->name('sales.dealer.category.view');
    Route::get('/sales/dealer/category/create',[DealerCategoryController::class,'create'])->name('sales.dealer.category.create');
    Route::post('/sales/dealer/category/store', [DealerCategoryController::class,'store'])->name('sales.dealer.category.store');
    Route::get('/sales/dealer/category/edit/{cat_id}', [DealerCategoryController::class,'edit'])->name('sales.dealer.category.edit');
    Route::post('/sales/dealer/category/update/{cat_id}', [DealerCategoryController::class,'update'])->name('sales.dealer.category.update');
    Route::post('/sales/dealer/category/destroy/{cat_id}', [DealerCategoryController::class,'destroy'])->name('sales.dealer.category.destroy');

    //sales/Dealer Type
    Route::get('/sales/dealer/type/',[DealerTypeController::class,'index'])->name('sales.dealer.type.view');
    Route::get('/sales/dealer/type/create',[DealerTypeController::class,'create'])->name('sales.dealer.type.create');
    Route::post('/sales/dealer/type/store', [DealerTypeController::class,'store'])->name('sales.dealer.type.store');
    Route::get('/sales/dealer/type/edit/{type_id}', [DealerTypeController::class,'edit'])->name('sales.dealer.type.edit');
    Route::post('/sales/dealer/type/update/{type_id}', [DealerTypeController::class,'update'])->name('sales.dealer.type.update');
    Route::post('/sales/dealer/type/destroy/{type_id}', [DealerTypeController::class,'destroy'])->name('sales.dealer.type.destroy');

    //sales/distributor-setup/Dealer Info
    Route::get('/sales/dealer/info/',[DealerController::class,'index'])->name('sales.dealer.view');
    Route::get('/sales/dealer/info/create',[DealerController::class,'create'])->name('sales.dealer.create');
    Route::post('/sales/dealer/info/store', [DealerController::class,'store'])->name('sales.dealer.store');
    Route::get('/sales/dealer/info/show/{dealer_id}', [DealerController::class,'show'])->name('sales.dealer.show');
    Route::get('/sales/dealer/info/edit/{dealer_id}', [DealerController::class,'edit'])->name('sales.dealer.edit');
    Route::post('/sales/dealer/info/update/{dealer_id}', [DealerController::class,'update'])->name('sales.dealer.update');
    Route::post('/sales/dealer/info/destroy/{dealer_id}', [DealerController::class,'destroy'])->name('sales.dealer.destroy');

    //sales/Trade Scheme
    Route::get('/sales/trade-scheme/',[TradeSchemeController::class,'index'])->name('sales.ts.view');
    Route::get('/sales/trade-scheme/create',[TradeSchemeController::class,'create'])->name('sales.ts.create');
    Route::post('/sales/trade-scheme/store', [TradeSchemeController::class,'store'])->name('sales.ts.store');
    Route::get('/sales/trade-scheme/show/{id}', [TradeSchemeController::class,'show'])->name('sales.ts.show');
    Route::get('/sales/trade-scheme/edit/{id}', [TradeSchemeController::class,'edit'])->name('sales.ts.edit');
    Route::post('/sales/trade-scheme/update/{id}', [TradeSchemeController::class,'update'])->name('sales.ts.update');
    Route::post('/sales/trade-scheme/destroy/{id}', [TradeSchemeController::class,'destroy'])->name('sales.ts.destroy');

    //sales/Credit Limit
    Route::get('/sales/credit-limit-request/',[CreditLimitController::class,'index'])->name('sales.cl.view');
    Route::get('/sales/credit-limit-request/create',[CreditLimitController::class,'create'])->name('sales.cl.create');
    Route::post('/sales/credit-limit-request/store', [CreditLimitController::class,'store'])->name('sales.cl.store');
    Route::get('/sales/credit-limit-request/show/{id}', [CreditLimitController::class,'show'])->name('sales.cl.show');
    Route::get('/sales/credit-limit-request/edit/{id}', [CreditLimitController::class,'edit'])->name('sales.cl.edit');
    Route::post('/sales/credit-limit-request/update/{id}', [CreditLimitController::class,'update'])->name('sales.cl.update');
    Route::post('/sales/credit-limit-request/destroy/{id}', [CreditLimitController::class,'destroy'])->name('sales.cl.destroy');

    //HRM/setup/Department
    Route::get('/hrm/setup/department/',[DepartmentController::class,'index'])->name('hrm.setup.department.view');
    Route::get('/hrm/setup/department/create',[DepartmentController::class,'create'])->name('hrm.setup.department.create');
    Route::post('/hrm/setup/department/store', [DepartmentController::class,'store'])->name('hrm.setup.department.store');
    Route::get('/hrm/setup/department/edit/{id}', [DepartmentController::class,'edit'])->name('hrm.setup.department.edit');
    Route::post('/hrm/setup/department/update/{id}', [DepartmentController::class,'update'])->name('hrm.setup.department.update');
    Route::post('/hrm/setup/department/destroy/{id}', [DepartmentController::class,'destroy'])->name('hrm.setup.department.destroy');

    //HRM/setup/Designation
    Route::get('/hrm/setup/designation/',[DesignationController::class,'index'])->name('hrm.setup.designation.view');
    Route::get('/hrm/setup/designation/create',[DesignationController::class,'create'])->name('hrm.setup.designation.create');
    Route::post('/hrm/setup/designation/store', [DesignationController::class,'store'])->name('hrm.setup.designation.store');
    Route::get('/hrm/setup/designation/edit/{id}', [DesignationController::class,'edit'])->name('hrm.setup.designation.edit');
    Route::post('/hrm/setup/designation/update/{id}', [DesignationController::class,'update'])->name('hrm.setup.designation.update');
    Route::post('/hrm/setup/designation/destroy/{id}', [DesignationController::class,'destroy'])->name('hrm.setup.designation.destroy');

    //HRM/setup/job Location
    Route::get('/hrm/setup/job-location/',[JobLocationController::class,'index'])->name('hrm.setup.jobLocation.view');
    Route::get('/hrm/setup/job-location/create',[JobLocationController::class,'create'])->name('hrm.setup.jobLocation.create');
    Route::post('/hrm/setup/job-location/store', [JobLocationController::class,'store'])->name('hrm.setup.jobLocation.store');
    Route::get('/hrm/setup/job-location/edit/{id}', [JobLocationController::class,'edit'])->name('hrm.setup.jobLocation.edit');
    Route::post('/hrm/setup/job-location/update/{id}', [JobLocationController::class,'update'])->name('hrm.setup.jobLocation.update');
    Route::post('/hrm/setup/job-location/destroy/{id}', [JobLocationController::class,'destroy'])->name('hrm.setup.jobLocation.destroy');

    //HRM/setup/Education Subject
    Route::get('/hrm/setup/education-subject/',[EduSubjectController::class,'index'])->name('hrm.setup.eduSubject.view');
    Route::get('/hrm/setup/education-subject/create',[EduSubjectController::class,'create'])->name('hrm.setup.eduSubject.create');
    Route::post('/hrm/setup/education-subject/store', [EduSubjectController::class,'store'])->name('hrm.setup.eduSubject.store');
    Route::get('/hrm/setup/education-subject/edit/{id}', [EduSubjectController::class,'edit'])->name('hrm.setup.eduSubject.edit');
    Route::post('/hrm/setup/education-subject/update/{id}', [EduSubjectController::class,'update'])->name('hrm.setup.eduSubject.update');
    Route::post('/hrm/setup/education-subject/destroy/{id}', [EduSubjectController::class,'destroy'])->name('hrm.setup.eduSubject.destroy');

    //HRM/setup/employment type
    Route::get('/hrm/setup/employment-type/',[EmploymentTypeController::class,'index'])->name('hrm.setup.employmentType.view');
    Route::get('/hrm/setup/employment-type/create',[EmploymentTypeController::class,'create'])->name('hrm.setup.employmentType.create');
    Route::post('/hrm/setup/employment-type/store', [EmploymentTypeController::class,'store'])->name('hrm.setup.employmentType.store');
    Route::get('/hrm/setup/employment-type/edit/{id}', [EmploymentTypeController::class,'edit'])->name('hrm.setup.employmentType.edit');
    Route::post('/hrm/setup/employment-type/update/{id}', [EmploymentTypeController::class,'update'])->name('hrm.setup.employmentType.update');
    Route::post('/hrm/setup/employment-type/destroy/{id}', [EmploymentTypeController::class,'destroy'])->name('hrm.setup.employmentType.destroy');

    //HRM/setup/Relation
    Route::get('/hrm/setup/relation/',[HrmRelationController::class,'index'])->name('hrm.setup.relation.view');
    Route::get('/hrm/setup/relation/create',[HrmRelationController::class,'create'])->name('hrm.setup.relation.create');
    Route::post('/hrm/setup/relation/store', [HrmRelationController::class,'store'])->name('hrm.setup.relation.store');
    Route::get('/hrm/setup/relation/edit/{id}', [HrmRelationController::class,'edit'])->name('hrm.setup.relation.edit');
    Route::post('/hrm/setup/relation/update/{id}', [HrmRelationController::class,'update'])->name('hrm.setup.relation.update');
    Route::post('/hrm/setup/relation/destroy/{id}', [HrmRelationController::class,'destroy'])->name('hrm.setup.relation.destroy');

    //HRM/setup/Univeristy
    Route::get('/hrm/setup/university/',[HrmUniversityController::class,'index'])->name('hrm.setup.university.view');
    Route::get('/hrm/setup/university/create',[HrmUniversityController::class,'create'])->name('hrm.setup.university.create');
    Route::post('/hrm/setup/university/store', [HrmUniversityController::class,'store'])->name('hrm.setup.university.store');
    Route::get('/hrm/setup/university/edit/{id}', [HrmUniversityController::class,'edit'])->name('hrm.setup.university.edit');
    Route::post('/hrm/setup/university/update/{id}', [HrmUniversityController::class,'update'])->name('hrm.setup.university.update');
    Route::post('/hrm/setup/university/destroy/{id}', [HrmUniversityController::class,'destroy'])->name('hrm.setup.university.destroy');

    //HRM/setup/type of Leave
    Route::get('/hrm/setup/leave-type/',[LeaveTypeController::class,'index'])->name('hrm.setup.leaveType.view');
    Route::get('/hrm/setup/leave-type/create',[LeaveTypeController::class,'create'])->name('hrm.setup.leaveType.create');
    Route::post('/hrm/setup/leave-type/store', [LeaveTypeController::class,'store'])->name('hrm.setup.leaveType.store');
    Route::get('/hrm/setup/leave-type/edit/{id}', [LeaveTypeController::class,'edit'])->name('hrm.setup.leaveType.edit');
    Route::post('/hrm/setup/leave-type/update/{id}', [LeaveTypeController::class,'update'])->name('hrm.setup.leaveType.update');
    Route::post('/hrm/setup/leave-type/destroy/{id}', [LeaveTypeController::class,'destroy'])->name('hrm.setup.leaveType.destroy');

    //HRM/setup/Holidays
    Route::get('/hrm/setup/holidays/',[HolidaysController::class,'index'])->name('hrm.setup.holidays.view');
    Route::get('/hrm/setup/holidays/create',[HolidaysController::class,'create'])->name('hrm.setup.holidays.create');
    Route::post('/hrm/setup/holidays/store', [HolidaysController::class,'store'])->name('hrm.setup.holidays.store');
    Route::get('/hrm/setup/holidays/edit/{id}', [HolidaysController::class,'edit'])->name('hrm.setup.holidays.edit');
    Route::post('/hrm/setup/holidays/update/{id}', [HolidaysController::class,'update'])->name('hrm.setup.holidays.update');
    Route::post('/hrm/setup/holidays/destroy/{id}', [HolidaysController::class,'destroy'])->name('hrm.setup.holidays.destroy');

    //HRM/setup/Educational Qualification
    Route::get('/hrm/setup/educational-qualification/',[EducationalQualificationController::class,'index'])->name('hrm.setup.eduQua.view');
    Route::get('/hrm/setup/educational-qualification/create',[EducationalQualificationController::class,'create'])->name('hrm.setup.eduQua.create');
    Route::post('/hrm/setup/educational-qualification/store', [EducationalQualificationController::class,'store'])->name('hrm.setup.eduQua.store');
    Route::get('/hrm/setup/educational-qualification/edit/{id}', [EducationalQualificationController::class,'edit'])->name('hrm.setup.eduQua.edit');
    Route::post('/hrm/setup/educational-qualification/update/{id}', [EducationalQualificationController::class,'update'])->name('hrm.setup.eduQua.update');
    Route::post('/hrm/setup/educational-qualification/destroy/{id}', [EducationalQualificationController::class,'destroy'])->name('hrm.setup.eduQua.destroy');

    //HRM/setup/Action Type
    Route::get('/hrm/setup/action-type/',[ActionTypeController::class,'index'])->name('hrm.setup.actionType.view');
    Route::get('/hrm/setup/action-type/create',[ActionTypeController::class,'create'])->name('hrm.setup.actionType.create');
    Route::post('/hrm/setup/action-type/store', [ActionTypeController::class,'store'])->name('hrm.setup.actionType.store');
    Route::get('/hrm/setup/action-type/edit/{id}', [ActionTypeController::class,'edit'])->name('hrm.setup.actionType.edit');
    Route::post('/hrm/setup/action-type/update/{id}', [ActionTypeController::class,'update'])->name('hrm.setup.actionType.update');
    Route::post('/hrm/setup/action-type/destroy/{id}', [ActionTypeController::class,'destroy'])->name('hrm.setup.actionType.destroy');

    //HRM/setup/Organization
    Route::get('/hrm/setup/organization/',[HrmOrganizationController::class,'index'])->name('hrm.setup.organization.view');
    Route::get('/hrm/setup/organization/create',[HrmOrganizationController::class,'create'])->name('hrm.setup.organization.create');
    Route::post('/hrm/setup/organization/store', [HrmOrganizationController::class,'store'])->name('hrm.setup.organization.store');
    Route::get('/hrm/setup/organization/edit/{id}', [HrmOrganizationController::class,'edit'])->name('hrm.setup.organization.edit');
    Route::post('/hrm/setup/organization/update/{id}', [HrmOrganizationController::class,'update'])->name('hrm.setup.organization.update');
    Route::post('/hrm/setup/organization/destroy/{id}', [HrmOrganizationController::class,'destroy'])->name('hrm.setup.organization.destroy');

    //HRM/setup/Education Exam Title
    Route::get('/hrm/setup/education-exam-title/',[EduExamTitleController::class,'index'])->name('hrm.setup.eduExamtitle.view');
    Route::get('/hrm/setup/education-exam-title/create',[EduExamTitleController::class,'create'])->name('hrm.setup.eduExamtitle.create');
    Route::post('/hrm/setup/education-exam-title/store', [EduExamTitleController::class,'store'])->name('hrm.setup.eduExamtitle.store');
    Route::get('/hrm/setup/education-exam-title/edit/{id}', [EduExamTitleController::class,'edit'])->name('hrm.setup.eduExamtitle.edit');
    Route::post('/hrm/setup/education-exam-title/update/{id}', [EduExamTitleController::class,'update'])->name('hrm.setup.eduExamtitle.update');
    Route::post('/hrm/setup/education-exam-title/destroy/{id}', [EduExamTitleController::class,'destroy'])->name('hrm.setup.eduExamtitle.destroy');

    //HRM/setup/Demotion Reason
    Route::get('/hrm/setup/demotion-reason/',[DemotionReasonController::class,'index'])->name('hrm.setup.demotionReason.view');
    Route::get('/hrm/setup/demotion-reason/create',[DemotionReasonController ::class,'create'])->name('hrm.setup.demotionReason.create');
    Route::post('/hrm/setup/demotion-reason/store', [DemotionReasonController::class,'store'])->name('hrm.setup.demotionReason.store');
    Route::get('/hrm/setup/demotion-reason/edit/{id}', [DemotionReasonController::class,'edit'])->name('hrm.setup.demotionReason.edit');
    Route::post('/hrm/setup/demotion-reason/update/{id}', [DemotionReasonController::class,'update'])->name('hrm.setup.demotionReason.update');
    Route::post('/hrm/setup/demotion-reason/destroy/{id}', [DemotionReasonController::class,'destroy'])->name('hrm.setup.demotionReason.destroy');

    //HRM/setup/Profession Type
    Route::get('/hrm/setup/profession-type/',[HrmProfessionController::class,'index'])->name('hrm.setup.profession.view');
    Route::get('/hrm/setup/profession-type/create',[HrmProfessionController ::class,'create'])->name('hrm.setup.profession.create');
    Route::post('/hrm/setup/profession-type/store', [HrmProfessionController::class,'store'])->name('hrm.setup.profession.store');
    Route::get('/hrm/setup/profession-type/edit/{id}', [HrmProfessionController::class,'edit'])->name('hrm.setup.profession.edit');
    Route::post('/hrm/setup/profession-type/update/{id}', [HrmProfessionController::class,'update'])->name('hrm.setup.profession.update');
    Route::post('/hrm/setup/profession-type/destroy/{id}', [HrmProfessionController::class,'destroy'])->name('hrm.setup.profession.destroy');

    //HRM/setup/Travel Scope
    Route::get('/hrm/setup/travel-scope/',[TravelScopeController::class,'index'])->name('hrm.setup.travelScope.view');
    Route::get('/hrm/setup/travel-scope/create',[TravelScopeController ::class,'create'])->name('hrm.setup.travelScope.create');
    Route::post('/hrm/setup/travel-scope/store', [TravelScopeController::class,'store'])->name('hrm.setup.travelScope.store');
    Route::get('/hrm/setup/travel-scope/edit/{id}', [TravelScopeController::class,'edit'])->name('hrm.setup.travelScope.edit');
    Route::post('/hrm/setup/travel-scope/update/{id}', [TravelScopeController::class,'update'])->name('hrm.setup.travelScope.update');
    Route::post('/hrm/setup/travel-scope/destroy/{id}', [TravelScopeController::class,'destroy'])->name('hrm.setup.travelScope.destroy');

    //HRM/setup/Travel Nature
    Route::get('/hrm/setup/travel-nature/',[TravelNatureController::class,'index'])->name('hrm.setup.travelNature.view');
    Route::get('/hrm/setup/travel-nature/create',[TravelNatureController ::class,'create'])->name('hrm.setup.travelNature.create');
    Route::post('/hrm/setup/travel-nature/store', [TravelNatureController::class,'store'])->name('hrm.setup.travelNature.store');
    Route::get('/hrm/setup/travel-nature/edit/{id}', [TravelNatureController::class,'edit'])->name('hrm.setup.travelNature.edit');
    Route::post('/hrm/setup/travel-nature/update/{id}', [TravelNatureController::class,'update'])->name('hrm.setup.travelNature.update');
    Route::post('/hrm/setup/travel-nature/destroy/{id}', [TravelNatureController::class,'destroy'])->name('hrm.setup.travelNature.destroy');

    //HRM/setup/Job Experience
    Route::get('/hrm/setup/job-experience/',[JobExperienceController::class,'index'])->name('hrm.setup.jobExperience.view');
    Route::get('/hrm/setup/job-experience/create',[JobExperienceController ::class,'create'])->name('hrm.setup.jobExperience.create');
    Route::post('/hrm/setup/job-experience/store', [JobExperienceController::class,'store'])->name('hrm.setup.jobExperience.store');
    Route::get('/hrm/setup/job-experience/edit/{id}', [JobExperienceController::class,'edit'])->name('hrm.setup.jobExperience.edit');
    Route::post('/hrm/setup/job-experience/update/{id}', [JobExperienceController::class,'update'])->name('hrm.setup.jobExperience.update');
    Route::post('/hrm/setup/job-experience/destroy/{id}', [JobExperienceController::class,'destroy'])->name('hrm.setup.jobExperience.destroy');

    //HRM/setup/Grade
    Route::get('/hrm/setup/grade/',[GradeController::class,'index'])->name('hrm.setup.grade.view');
    Route::get('/hrm/setup/grade/create',[GradeController ::class,'create'])->name('hrm.setup.grade.create');
    Route::post('/hrm/setup/grade/store', [GradeController::class,'store'])->name('hrm.setup.grade.store');
    Route::get('/hrm/setup/grade/edit/{id}', [GradeController::class,'edit'])->name('hrm.setup.grade.edit');
    Route::post('/hrm/setup/grade/update/{id}', [GradeController::class,'update'])->name('hrm.setup.grade.update');
    Route::post('/hrm/setup/grade/destroy/{id}', [GradeController::class,'destroy'])->name('hrm.setup.grade.destroy');

    //HRM/setup/shift
    Route::get('/hrm/setup/shift/',[ShiftController::class,'index'])->name('hrm.setup.shift.view');
    Route::get('/hrm/setup/shift/create',[ShiftController ::class,'create'])->name('hrm.setup.shift.create');
    Route::post('/hrm/setup/shift/store', [ShiftController::class,'store'])->name('hrm.setup.shift.store');
    Route::get('/hrm/setup/shift/edit/{id}', [ShiftController::class,'edit'])->name('hrm.setup.shift.edit');
    Route::post('/hrm/setup/shift/update/{id}', [ShiftController::class,'update'])->name('hrm.setup.shift.update');
    Route::post('/hrm/setup/shift/destroy/{id}', [ShiftController::class,'destroy'])->name('hrm.setup.shift.destroy');

    //HRM/setup/blood
    Route::get('/hrm/setup/blood/',[BloodController::class,'index'])->name('hrm.setup.blood.view');
    Route::get('/hrm/setup/blood/create',[BloodController ::class,'create'])->name('hrm.setup.blood.create');
    Route::post('/hrm/setup/blood/store', [BloodController::class,'store'])->name('hrm.setup.blood.store');
    Route::get('/hrm/setup/blood/edit/{id}', [BloodController::class,'edit'])->name('hrm.setup.blood.edit');
    Route::post('/hrm/setup/blood/update/{id}', [BloodController::class,'update'])->name('hrm.setup.blood.update');
    Route::post('/hrm/setup/blood/destroy/{id}', [BloodController::class,'destroy'])->name('hrm.setup.blood.destroy');

    //HRM/setup/Religion
    Route::get('/hrm/setup/religion/',[ReligionController::class,'index'])->name('hrm.setup.religion.view');
    Route::get('/hrm/setup/religion/create',[ReligionController ::class,'create'])->name('hrm.setup.religion.create');
    Route::post('/hrm/setup/religion/store', [ReligionController::class,'store'])->name('hrm.setup.religion.store');
    Route::get('/hrm/setup/religion/edit/{id}', [ReligionController::class,'edit'])->name('hrm.setup.religion.edit');
    Route::post('/hrm/setup/religion/update/{id}', [ReligionController::class,'update'])->name('hrm.setup.religion.update');
    Route::post('/hrm/setup/religion/destroy/{id}', [ReligionController::class,'destroy'])->name('hrm.setup.religion.destroy');


    //HRM/setup/Employee Information
    Route::get('/hrm/employee/',[EmployeeController::class,'index'])->name('hrm.employee.view');
    Route::get('/hrm/employee/create',[EmployeeController ::class,'create'])->name('hrm.employee.create');
    Route::post('/hrm/employee/store', [EmployeeController::class,'store'])->name('hrm.employee.store');
    // contact info
    Route::post('/hrm/employee/contact-information/store', [EmployeeController::class,'contactInformationStore'])->name('hrm.employeeContactInfo.store');
    // job info
    Route::post('/hrm/employee/job-information/store', [EmployeeController::class,'jobInfoStore'])->name('hrm.employeeJobInfo.store');
    // family info
    Route::post('/hrm/employee/family-information/store', [EmployeeController::class,'familyInfoStore'])->name('hrm.employeeFamilyInfo.store');
    Route::post('/hrm/employee/family-information/destroy/{id}', [EmployeeController::class,'familyInformationDestroy'])->name('hrm.employeeFamilyInfo.destroy');
    // Education info
    Route::post('/hrm/employee/education-information/store', [EmployeeController::class,'educationInfoStore'])->name('hrm.employeeEducationInfo.store');
    Route::post('/hrm/employee/education-information/destroy/{id}', [EmployeeController::class,'educationInformationDestroy'])->name('hrm.employeeEducationInfo.destroy');
    // Employment info
    Route::post('/hrm/employee/employment-information/store', [EmployeeController::class,'employmentInfoStore'])->name('hrm.employeeEmploymentInfo.store');
    Route::post('/hrm/employee/employment-information/destroy/{id}', [EmployeeController::class,'employmentInformationDestroy'])->name('hrm.employeeEmploymentInfo.destroy');
    // Supervisor info
    Route::post('/hrm/employee/supervisor-information/store', [EmployeeController::class,'supervisorInfoStore'])->name('hrm.employeeSupervisorInfo.store');
    Route::post('/hrm/employee/supervisor-information/destroy/{id}', [EmployeeController::class,'supervisorInformationDestroy'])->name('hrm.employeeSupervisorInfo.destroy');
    // Document info
    Route::post('/hrm/employee/document-information/store', [EmployeeController::class,'documentInfoStore'])->name('hrm.employeeDocumentInfo.store');
    Route::post('/hrm/employee/document-information/destroy/{id}', [EmployeeController::class,'documentInformationDestroy'])->name('hrm.employeeDocumentInfo.destroy');
    // Language skill info
    Route::post('/hrm/employee/language-skill/store', [EmployeeController::class,'languageInfoStore'])->name('hrm.employeeLanguageInfo.store');
    Route::post('/hrm/employee/language-skill/destroy/{id}', [EmployeeController::class,'languageInformationDestroy'])->name('hrm.employeeLanguageInfo.destroy');
    // Hrm/employee/Bank A/c info
    Route::post('/hrm/employee/bank-account/store', [EmployeeController::class,'bankAccountInfoStore'])->name('hrm.employeeBankInfo.store');
    Route::post('/hrm/employee/bank-account/destroy/{id}', [EmployeeController::class,'bankInformationDestroy'])->name('hrm.employeeBankInfo.destroy');

    // Hrm/employee/Social Media info
    Route::post('/hrm/employee/social-media-info/store', [EmployeeController::class,'socialMediaInfoStore'])->name('hrm.employeeBankInfo.store');
    Route::post('/hrm/employee/social-media-info/destroy/{id}', [EmployeeController::class,'socialMediaDestroy'])->name('hrm.employeeBankInfo.destroy');

    // Hrm/employee/Talent info
    Route::post('/hrm/employee/talent-info/store', [EmployeeController::class,'talentInfoStore'])->name('hrm.employeeTalentInfo.store');
    Route::post('/hrm/employee/talent-info/destroy/{id}', [EmployeeController::class,'talentInfoDestroy'])->name('hrm.employeeTalentInfo.destroy');


    Route::get('/hrm/employee/edit/{id}', [EmployeeController::class,'edit'])->name('hrm.employee.edit');
    Route::get('/hrm/employee/show/{id}', [EmployeeController::class,'show'])->name('hrm.employee.show');
    Route::post('/hrm/employee/update/{id}', [EmployeeController::class,'update'])->name('hrm.employee.update');
    Route::post('/hrm/employee/contact-information/update/{id}', [EmployeeController::class,'contactInformationUpdate'])->name('hrm.employeeContactInfo.update');
    Route::post('/hrm/employee/job-information/update/{id}', [EmployeeController::class,'jobInformationUpdate'])->name('hrm.employeeJobInfo.update');
    Route::post('/hrm/employee/destroy/{id}', [EmployeeController::class,'destroy'])->name('hrm.employee.destroy');

    // HRM/ Payroll / Salary Scale info
    Route::get('/hrm/payroll/salary-scale/',[HrmPayrollSalaryScaleController::class,'index'])->name('hrm.payroll.salaryScale');
    Route::get('/hrm/payroll/salary-scale/create/',[HrmPayrollSalaryScaleController::class,'create'])->name('hrm.payroll.salaryScale.create');
    Route::post('/hrm/payroll/salary-scale/store',[HrmPayrollSalaryScaleController::class,'store'])->name('hrm.payroll.salaryScale.store');
    Route::get('/hrm/payroll/salary-scale/edit/{id}',[HrmPayrollSalaryScaleController::class,'edit'])->name('hrm.payroll.salaryScale.edit');
    Route::post('/hrm/payroll/salary-scale/update/{id}',[HrmPayrollSalaryScaleController::class,'update'])->name('hrm.payroll.salaryScale.update');
    Route::post('/hrm/payroll/salary-scale/destroy/{id}',[HrmPayrollSalaryScaleController::class,'destroy'])->name('hrm.payroll.salaryScale.destroy');

    // HRM/ Payroll / Salary and allowance info
    Route::get('/hrm/payroll/salary-and-allowance/',[HrmPayrollSalaryController::class,'index'])->name('hrm.payroll.salary');
    Route::get('/hrm/payroll/salary-and-allowance/create/{id}',[HrmPayrollSalaryController::class,'create'])->name('hrm.payroll.salary.create');



    // HRM/ Attendance / Leave Application
    Route::get('/hrm/attendance/leave-application/',[HrmAttendanceLeaveController::class,'index'])->name('hrm.attendance.leave');
    Route::get('/hrm/attendance/leave-application/show/{id}',[HrmAttendanceLeaveController::class,'show'])->name('hrm.attendance.leave.show');
    Route::post('/hrm/attendance/leave-application/granted/{id}',[HrmAttendanceLeaveController::class,'approve'])->name('hrm.attendance.leave.approve');
    Route::post('/hrm/attendance/leave-application/reject/{id}',[HrmAttendanceLeaveController::class,'reject'])->name('hrm.attendance.leave.reject');

    // Employee Access/ Attendance / Leave Application
    Route::get('/employee-access/attendance/leave-application/',[EALeaveApplicationController::class,'index'])->name('ea.attendance.leaveApplication');
    Route::get('/employee-access/attendance/leave-application/create/',[EALeaveApplicationController::class,'create'])->name('ea.attendance.leaveApplication.create');
    Route::get('/get-type-balance/{category}',[EALeaveApplicationController::class,'getTypeBalance']);
    Route::post('/employee-access/attendance/leave-application/store',[EALeaveApplicationController::class,'store'])->name('ea.attendance.leaveApplication.store');
    Route::get('/employee-access/attendance/leave-application/edit/{id}',[EALeaveApplicationController::class,'edit'])->name('ea.attendance.leaveApplication.edit');
    Route::get('/employee-access/attendance/leave-application/show/{id}',[EALeaveApplicationController::class,'show'])->name('ea.attendance.leaveApplication.show');
    Route::post('/employee-access/attendance/leave-application/send/{id}',[EALeaveApplicationController::class,'send'])->name('ea.attendance.leaveApplication.send');
    Route::post('/employee-access/attendance/leave-application/update/{id}',[EALeaveApplicationController::class,'update'])->name('ea.attendance.leaveApplication.update');
    Route::post('/employee-access/attendance/leave-application/destroy/{id}',[EALeaveApplicationController::class,'destroy'])->name('ea.attendance.leaveApplication.destroy');
    Route::get('/employee-access/attendance/leave-application/download/{id}', [EALeaveApplicationController::class,'download'])->name('ea.attendance.leaveApplication.download');

    // Employee Access/ Attendance / Early Leave Application
    Route::get('/employee-access/attendance/early-leave-application/',[EaEarlyLeaveApplicationController::class,'index'])->name('ea.attendance.earlyLeaveApplication');
    Route::get('/employee-access/attendance/early-leave-application/create/',[EaEarlyLeaveApplicationController::class,'create'])->name('ea.attendance.earlyLeaveApplication.create');
    Route::post('/employee-access/attendance/early-leave-application/store',[EaEarlyLeaveApplicationController::class,'store'])->name('ea.attendance.earlyLeaveApplication.store');
    Route::get('/employee-access/attendance/early-leave-application/edit/{id}',[EaEarlyLeaveApplicationController::class,'edit'])->name('ea.attendance.earlyLeaveApplication.edit');
    Route::get('/employee-access/attendance/early-leave-application/show/{id}',[EaEarlyLeaveApplicationController::class,'show'])->name('ea.attendance.earlyLeaveApplication.show');
    Route::post('/employee-access/attendance/early-leave-application/send/{id}',[EaEarlyLeaveApplicationController::class,'send'])->name('ea.attendance.earlyLeaveApplication.send');
    Route::post('/employee-access/attendance/early-leave-application/update/{id}',[EaEarlyLeaveApplicationController::class,'update'])->name('ea.attendance.earlyLeaveApplication.update');
    Route::post('/employee-access/attendance/early-leave-application/destroy/{id}',[EaEarlyLeaveApplicationController::class,'destroy'])->name('ea.attendance.earlyLeaveApplication.destroy');
    Route::get('/employee-access/attendance/early-leave-application/download/{id}', [EaEarlyLeaveApplicationController::class,'download'])->name('ea.attendance.earlyLeaveApplication.download');

    // Employee Access/ Attendance / Late Attendance Application
    Route::get('/employee-access/attendance/late-attendance-application/',[EALateAttendanceApplicationController::class,'index'])->name('ea.attendance.lateAttendanceApplication');
    Route::get('/employee-access/attendance/late-attendance-application/create/',[EALateAttendanceApplicationController::class,'create'])->name('ea.attendance.lateAttendanceApplication.create');
    Route::post('/employee-access/attendance/late-attendance-application/store',[EALateAttendanceApplicationController::class,'store'])->name('ea.attendance.lateAttendanceApplication.store');
    Route::get('/employee-access/attendance/late-attendance-application/edit/{id}',[EALateAttendanceApplicationController::class,'edit'])->name('ea.attendance.lateAttendanceApplication.edit');
    Route::get('/employee-access/attendance/late-attendance-application/show/{id}',[EALateAttendanceApplicationController::class,'show'])->name('ea.attendance.lateAttendanceApplication.show');
    Route::post('/employee-access/attendance/late-attendance-application/send/{id}',[EALateAttendanceApplicationController::class,'send'])->name('ea.attendance.lateAttendanceApplication.send');
    Route::post('/employee-access/attendance/late-attendance-application/update/{id}',[EALateAttendanceApplicationController::class,'update'])->name('ea.attendance.lateAttendanceApplication.update');
    Route::post('/employee-access/attendance/late-attendance-application/destroy/{id}',[EALateAttendanceApplicationController::class,'destroy'])->name('ea.attendance.lateAttendanceApplication.destroy');
    Route::get('/employee-access/attendance/late-attendance-application/download/{id}', [EALateAttendanceApplicationController::class,'download'])->name('ea.attendance.lateAttendanceApplication.download');

    // Employee Access/ Attendance / Outdoor Duty
    Route::get('/employee-access/attendance/outdoor-duty/',[EaOutDoorDutyController::class,'index'])->name('ea.attendance.outdoorDuty');
    Route::get('/employee-access/attendance/outdoor-duty/create/',[EaOutDoorDutyController::class,'create'])->name('ea.attendance.outdoorDuty.create');
    Route::post('/employee-access/attendance/outdoor-duty/store',[EaOutDoorDutyController::class,'store'])->name('ea.attendance.outdoorDuty.store');
    Route::get('/employee-access/attendance/outdoor-duty/edit/{id}',[EaOutDoorDutyController::class,'edit'])->name('ea.attendance.outdoorDuty.edit');
    Route::get('/employee-access/attendance/outdoor-duty/show/{id}',[EaOutDoorDutyController::class,'show'])->name('ea.attendance.outdoorDuty.show');
    Route::post('/employee-access/attendance/outdoor-duty/send/{id}',[EaOutDoorDutyController::class,'send'])->name('ea.attendance.outdoorDuty.send');
    Route::post('/employee-access/attendance/outdoor-duty/update/{id}',[EaOutDoorDutyController::class,'update'])->name('ea.attendance.outdoorDuty.update');
    Route::post('/employee-access/attendance/outdoor-duty/destroy/{id}',[EaOutDoorDutyController::class,'destroy'])->name('ea.attendance.outdoorDuty.destroy');
    Route::get('/employee-access/attendance/outdoor-duty/download/{id}', [EaOutDoorDutyController::class,'download'])->name('ea.attendance.outdoorDuty.download');

    // Employee Access/ Recommend / Leave Application
    Route::get('/employee-access/recommendation/leave/',[EaRecommendationLeaveController::class,'index'])->name('ea.recommendation.leave');
    Route::get('/employee-access/recommendation/leave/show/{id}',[EaRecommendationLeaveController::class,'show'])->name('ea.attendance.recommendation.leave.show');
    Route::post('/employee-access/recommendation/leave/recommend/{id}',[EaRecommendationLeaveController::class,'recommend'])->name('ea.recommendation.leave.recommend');
    Route::post('/employee-access/recommendation/leave/reject/{id}',[EaRecommendationLeaveController::class,'reject'])->name('ea.recommendation.leave.reject');

    // Employee Access/ Recommend / Early Leave Application
    Route::get('/employee-access/recommendation/early-leave/',[EaRecommendationEarlyLeaveController::class,'index'])->name('ea.recommendation.earlyLeave');
    Route::get('/employee-access/recommendation/early-leave/show/{id}',[EaRecommendationEarlyLeaveController::class,'show'])->name('ea.recommendation.earlyLeave.show');
    Route::post('/employee-access/recommendation/early-leave/recommend/{id}',[EaRecommendationEarlyLeaveController::class,'recommend'])->name('ea.recommendation.earlyLeave.recommend');
    Route::post('/employee-access/recommendation/early-leave/reject/{id}',[EaRecommendationEarlyLeaveController::class,'reject'])->name('ea.recommendation.earlyLeave.reject');

    // Employee Access/ Approval / Leave Application
    Route::get('/employee-access/approval/leave/',[EaApprovalLeaveController::class,'index'])->name('ea.approval.leave');
    Route::get('/employee-access/approval/leave/show/{id}',[EaApprovalLeaveController::class,'show'])->name('ea.attendance.approval.leave.show');
    Route::post('/employee-access/approval/leave/approve/{id}',[EaApprovalLeaveController::class,'approve'])->name('ea.approval.leave.approve');
    Route::post('/employee-access/approval/leave/reject/{id}',[EaApprovalLeaveController::class,'reject'])->name('ea.approval.leave.reject');

    // Employee Access/ Responsible for / Leave
    Route::get('/employee-access/responsible-for/leave/',[EaResponsibleForLeaveController::class,'index'])->name('ea.responsibleFor.leave');
    Route::get('/employee-access/responsible-for/leave/show/{id}',[EaResponsibleForLeaveController::class,'show'])->name('ea.responsibleFor.leave.show');
    Route::post('/employee-access/responsible-for/leave/accept/{id}',[EaResponsibleForLeaveController::class,'accept'])->name('ea.responsibleFor.leave.accept');
    Route::post('/employee-access/responsible-for/leave/reject/{id}',[EaResponsibleForLeaveController::class,'reject'])->name('ea.responsibleFor.leave.reject');

    // Employee Access/ Responsible for / Early Leave
    Route::get('/employee-access/responsible-for/early-leave/',[EaResponsibleForEarlyLeaveController::class,'index'])->name('ea.responsibleFor.earlyLeave');
    Route::get('/employee-access/responsible-for/early-leave/show/{id}',[EaResponsibleForEarlyLeaveController::class,'show'])->name('ea.responsibleFor.earlyLeave.show');
    Route::post('/employee-access/responsible-for/early-leave/accept/{id}',[EaResponsibleForEarlyLeaveController::class,'accept'])->name('ea.responsibleFor.earlyLeave.accept');
    Route::post('/employee-access/responsible-for/early-leave/reject/{id}',[EaResponsibleForEarlyLeaveController::class,'reject'])->name('ea.responsibleFor.earlyLeave.reject');


    // MIS/ User / Create User
    Route::get('/mis/user/create-user/',[MISCreateUserController::class,'index'])->name('mis.user.createUser');
    Route::get('/mis/user/create-user-manual/',[MISCreateUserController::class,'indexManual'])->name('mis.user.createUserManual');
    Route::get('/mis/user/create-user/create/',[MISCreateUserController::class,'create'])->name('mis.user.createUser.create');
    Route::get('/mis/user/create-user/data-extracted-from-employee-info/{id}',[MISCreateUserController::class,'createWithData'])->name('mis.user.createUser.createWithData');
    Route::post('/mis/user/create-user/storeWithData',[MISCreateUserController::class,'storeWithData'])->name('mis.user.createUser.storeWithData');
    Route::post('/mis/user/create-user/store',[MISCreateUserController::class,'store'])->name('mis.user.createUser.store');
    Route::get('/mis/user/create-user/edit/{id}',[MISCreateUserController::class,'edit'])->name('mis.user.createUser.edit');
    Route::get('/mis/user/create-user/show/{id}',[MISCreateUserController::class,'show'])->name('mis.user.createUser.show');
    Route::post('/mis/user/create-user/update/{id}',[MISCreateUserController::class,'update'])->name('mis.user.createUser.update');
    Route::post('/mis/user/create-user/destroy/{id}',[MISCreateUserController::class,'destroy'])->name('mis.user.createUser.destroy');

    // MIS / Permission Matrix / Company
        Route::get('/mis/permission-matrix/company',[MISPMCompanyController::class,'index'])->name('mis.permissionMatrix.company');
        Route::get('/mis/permission-matrix/company/create/{id}',[MISPMCompanyController::class,'create'])->name('mis.permissionMatrix.company.create');
        Route::post('/mis/permission-matrix/company/store',[MISPMCompanyController::class,'store'])->name('mis.permissionMatrix.company.store');
        Route::post('/mis/permission-matrix/company/update/{id}',[MISPMCompanyController::class,'update'])->name('mis.permissionMatrix.company.update');

    // MIS / Permission Matrix / Module
        Route::get('/mis/permission-matrix/module',[MISPMModuleController::class,'index'])->name('mis.permissionMatrix.module');
        Route::get('/mis/permission-matrix/module/create/{id}',[MISPMModuleController::class,'create'])->name('mis.permissionMatrix.module.create');
        Route::post('/mis/permission-matrix/module/store',[MISPMModuleController::class,'store'])->name('mis.permissionMatrix.module.store');
        Route::post('/mis/permission-matrix/module/update/{id}',[MISPMModuleController::class,'update'])->name('mis.permissionMatrix.module.update');

    // MIS / Permission Matrix / Main Menu
        Route::get('/mis/permission-matrix/main-menu',[MISPMMainMenuController::class,'index'])->name('mis.permissionMatrix.mainMenu');
        Route::get('/mis/permission-matrix/main-menu/create/{id}',[MISPMMainMenuController::class,'create'])->name('mis.permissionMatrix.mainMenu.create');
        Route::post('/mis/permission-matrix/main-menu/store',[MISPMMainMenuController::class,'store'])->name('mis.permissionMatrix.mainMenu.store');
        Route::post('/mis/permission-matrix/main-menu/update/{id}',[MISPMMainMenuController::class,'update'])->name('mis.permissionMatrix.mainMenu.update');

    // MIS / Permission Matrix / Sub Menu
        Route::get('/mis/permission-matrix/sub-menu',[MISPMSubMenuController::class,'index'])->name('mis.permissionMatrix.subMenu');
        Route::get('/mis/permission-matrix/sub-menu/create/{id}',[MISPMSubMenuController::class,'create'])->name('mis.permissionMatrix.subMenu.create');
        Route::post('/mis/permission-matrix/sub-menu/store',[MISPMSubMenuController::class,'store'])->name('mis.permissionMatrix.subMenu.store');
        Route::post('/mis/permission-matrix/sub-menu/update/{id}',[MISPMSubMenuController::class,'update'])->name('mis.permissionMatrix.subMenu.update');

    // MIS / Permission Matrix / others
        Route::get('/mis/permission-matrix/other-options',[MISPMOtherOptionsController::class,'index'])->name('mis.permissionMatrix.otherOptions');
        Route::get('/mis/permission-matrix/other-options/create/{id}',[MISPMOtherOptionsController::class,'create'])->name('mis.permissionMatrix.otherOptions.create');
        Route::post('/mis/permission-matrix/other-options/store',[MISPMOtherOptionsController::class,'store'])->name('mis.permissionMatrix.otherOptions.store');
        Route::post('/mis/permission-matrix/other-options/update/{id}',[MISPMOtherOptionsController::class,'update'])->name('mis.permissionMatrix.otherOptions.update');
    // MIS / Permission Matrix / Warehouse
        Route::get('/mis/permission-matrix/warehouse',[MISPMWarehouseController::class,'index'])->name('mis.permissionMatrix.warehouse');
        Route::get('/mis/permission-matrix/warehouse/create/{id}',[MISPMWarehouseController::class,'create'])->name('mis.permissionMatrix.warehouse.create');
        Route::post('/mis/permission-matrix/warehouse/store',[MISPMWarehouseController::class,'store'])->name('mis.permissionMatrix.warehouse.store');
        Route::post('/mis/permission-matrix/warehouse/update/{id}',[MISPMWarehouseController::class,'update'])->name('mis.permissionMatrix.warehouse.update');
    // MIS / Permission Matrix / Reports
        Route::get('/mis/permission-matrix/reports',[MISPMReportController::class,'index'])->name('mis.permissionMatrix.reports');
        Route::get('/mis/permission-matrix/reports/create/{id}',[MISPMReportController::class,'create'])->name('mis.permissionMatrix.reports.create');
        Route::post('/mis/permission-matrix/reports/store/',[MISPMReportController::class,'store'])->name('mis.permissionMatrix.reports.store');
        Route::post('/mis/permission-matrix/reports/update/{id}',[MISPMReportController::class,'update'])->name('mis.permissionMatrix.reports.update');

    Route::get('/underconstraction/',function () {return 'This page is under construction';})->name('under.construction');

});

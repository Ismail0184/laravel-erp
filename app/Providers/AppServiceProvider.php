<?php

namespace App\Providers;

use App\Models\Accounts\AccTransactions;
use App\Models\Developer\DevMainMenu;
use App\Models\employeeAccess\attendance\EaLeaveApplication;
use Illuminate\Support\ServiceProvider;
use View;
use Session;
use Blade;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Session::put('module_id', 'module_id');
        View::composer(['layouts.app'], function ($view) {

            $mainMenus = DevMainMenu::where('status','1')->where('module_id',\Session::get('module_id', 'module_id'))->orderBy('serial','ASC')->get();
            $responsibleForLeaveCount = EaLeaveApplication::where('responsible_person_acceptance_status','PENDING')->where('responsible_person',Auth::user()->id)->count();
            $totalResponsibleCount = $responsibleForLeaveCount;

            $recommendationForLeaveCount = EaLeaveApplication::where('status','PENDING')->where('recommended_status','PENDING')->where('recommended_by',Auth::user()->id)->count();
            $totalRecommendationCount = $recommendationForLeaveCount;


            $approvalForLeaveCount = EaLeaveApplication::where('status','RECOMMENDED')->where('approved_status','PENDING')->where('approved_by',Auth::user()->id)->count();
            $totalApprovalCount = $approvalForLeaveCount;

            $view->with(
                [
                    'mainmenus' => $mainMenus,

                    'responsibleForLeaveCount' => $responsibleForLeaveCount,
                    'totalResponsibleCount' => $totalResponsibleCount,

                    'recommendationForLeaveCount' => $recommendationForLeaveCount,
                    'totalRecommendationCount' => $totalRecommendationCount,

                    'approvalForLeaveCount' => $approvalForLeaveCount,
                    'totalApprovalCount' => $totalApprovalCount,


                ]
            );
        });
    }
}

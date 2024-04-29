<?php

namespace App\Providers;

use App\Models\Developer\Builder\DevMainMenu;
use App\Models\employeeAccess\attendance\EaEarlyLeaveApplication;
use App\Models\employeeAccess\attendance\EaLeaveApplication;
use Auth;
use Blade;
use Illuminate\Support\ServiceProvider;
use Session;
use View;

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
            $mainMenus = DevMainMenu::where('status', '1')->where('module_id', \Session::get('module_id', 'module_id'))->orderBy('serial', 'ASC')->get();

            // Employee Access
            if (\Session::get('module_id')==11) {
                $responsibleForLeaveCount = EaLeaveApplication::whereNotIn('status',['DRAFTED','DELETED'])->where('responsible_person_acceptance_status', 'PENDING')->where('responsible_person', Auth::user()->id)->count();
                $responsibleForEarlyLeaveCount = EaEarlyLeaveApplication::whereNotIn('status',['DRAFTED','DELETED'])->where('responsible_person_acceptance_status', 'PENDING')->where('responsible_person', Auth::user()->id)->count();
                $totalResponsibleCount = $responsibleForLeaveCount+$responsibleForEarlyLeaveCount;

                $recommendationForLeaveCount = EaLeaveApplication::where('status', 'PENDING')->where('recommended_status', 'PENDING')->where('recommended_by', Auth::user()->id)->count();
                $totalRecommendationCount = $recommendationForLeaveCount;


                $approvalForLeaveCount = EaLeaveApplication::where('status', 'RECOMMENDED')->where('approved_status', 'PENDING')->where('approved_by', Auth::user()->id)->count();
                $totalApprovalCount = $approvalForLeaveCount;
                $view->with(
                    [
                        'mainmenus' => $mainMenus,

                        'responsibleForLeaveCount' => $responsibleForLeaveCount,
                        'responsibleForEarlyLeaveCount' => $responsibleForEarlyLeaveCount,
                        'totalResponsibleCount' => $totalResponsibleCount,

                        'recommendationForLeaveCount' => $recommendationForLeaveCount,
                        'totalRecommendationCount' => $totalRecommendationCount,

                        'approvalForLeaveCount' => $approvalForLeaveCount,
                        'totalApprovalCount' => $totalApprovalCount,
                    ]
                );
            } elseif(\Session::get('module_id')==10) {

                $grantedForLeaveCount = EaLeaveApplication::where('status', 'APPROVED')->where('granted_status', 'PENDING')->count();
                $totalAttendanceRequest = $grantedForLeaveCount;

                $view->with(
                    [
                        'mainmenus' => $mainMenus,
                        'grantedForLeaveCount' => $grantedForLeaveCount,
                        'totalAttendanceRequest' => $totalAttendanceRequest,

                    ]
                );

            } else {
                $view->with(
                    [
                        'mainmenus' => $mainMenus,
                    ]
                );
            }

        });
    }
}

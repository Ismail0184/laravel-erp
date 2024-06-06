<?php

namespace App\Providers;

use App\Models\Developer\Builder\DevMainMenu;
use App\Models\employeeAccess\attendance\EaEarlyLeaveApplication;
use App\Models\employeeAccess\attendance\EaLeaveApplication;
use Auth;
use Blade;
use Illuminate\Support\Facades\DB;
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

            $mainMenus = DB::table('mis_user_permission_matrix_main_menus as p')
                ->join('dev_main_menus as d', 'p.main_menu_id', '=', 'd.main_menu_id')
                ->where('p.user_id', Auth::user()->id)->where('p.status', 'active')->where('d.status', '1')->where('d.module_id',\Session::get('module_id'))
                ->select('d.*')
                ->orderBy('serial', 'ASC')->get();
            foreach ($mainMenus as $mainMenu) {
                $subMenu = DB::table('mis_user_permission_matrix_sub_menus as p')
                    ->join('dev_sub_menus as d', 'p.sub_menu_id', '=', 'd.sub_menu_id')
                    ->where('p.user_id', Auth::user()->id)->where('p.status', 'active')->where('d.status', 'active')->where('d.main_menu_id',$mainMenu->main_menu_id)->where('d.module_id',\Session::get('module_id'))
                    ->select('d.*')
                    ->orderBy('serial')
                    ->get();
                $mainMenu->subMenu = $subMenu;
            }


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

<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Auth;

trait SharedOtherOptionFunctionsTrait
{
    public function findVoucherCheckOptionAccess()
    {
        $checkForAccess =  DB::table('mis_user_permission_matrix_other_options as p')
            ->join('dev_builder_others as d', 'p.other_option_id', '=', 'd.id')
            ->where('p.user_id', Auth::user()->id)->where('p.status', 'active')->where('d.status', 'active')->where('d.key','voucher_check')
            ->select('p.other_option_id')
            ->count();
        $accessResult = $checkForAccess ?? 0;

        return $accessResult;
    }

    public function findVoucherApproveOptionAccess()
    {
        $checkForAccess =  DB::table('mis_user_permission_matrix_other_options as p')
            ->join('dev_builder_others as d', 'p.other_option_id', '=', 'd.id')
            ->where('p.user_id', Auth::user()->id)->where('p.status', 'active')->where('d.status', 'active')->where('d.key','voucher_approve')
            ->select('p.other_option_id')
            ->count();
        $accessResult = $checkForAccess ?? 0;

        return $accessResult;
    }

    public function findVoucherAuditOptionAccess()
    {
        $checkForAccess =  DB::table('mis_user_permission_matrix_other_options as p')
            ->join('dev_builder_others as d', 'p.other_option_id', '=', 'd.id')
            ->where('p.user_id', Auth::user()->id)->where('p.status', 'active')->where('d.status', 'active')->where('d.key','voucher_audit')
            ->select('p.other_option_id')
            ->count();
        $accessResult = $checkForAccess ?? 0;

        return $accessResult;
    }

    public function deletedVoucherRecoveryAccess()
    {
        $checkForAccess =  DB::table('mis_user_permission_matrix_other_options as p')
            ->join('dev_builder_others as d', 'p.other_option_id', '=', 'd.id')
            ->where('p.user_id', Auth::user()->id)->where('p.status', 'active')->where('d.status', 'active')->where('d.key','deleted_voucher_recovery_access')
            ->select('p.other_option_id')
            ->count();
        $accessResult = $checkForAccess ?? 0;

        return $accessResult;
    }
}


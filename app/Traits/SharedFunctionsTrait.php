<?php

namespace App\Traits;

use App\Models\Developer\UsageControl\DevUsageControlMeta;

trait SharedFunctionsTrait
{
    public function sharedFunction()
    {
        $checkBackDateEntryPermission = DevUsageControlMeta::where('meta_key','back_date_voucher_entry_access')->where('status','active')->first();
        $minDatePermission = $checkBackDateEntryPermission->meta_value ?? 0;
        return $minDatePermission;
    }

    public function checkVoucherEditAccessByCreatedPerson()
    {
        $checkForAccess = DevUsageControlMeta::where('meta_key','voucher_edit_access_by_created_person')->where('status','active')->first();
        $accessDays = $checkForAccess->meta_value ?? 0;
        return $accessDays;
    }

    public function checkLedgerBalanceBeforeMakingPayment()
    {
        $checkForAccess = DevUsageControlMeta::where('meta_key','check_ledger_balance_before_making_payment')->where('status','active')->first();
        $accessDays = $checkForAccess->meta_value ?? 0;
        return $accessDays;
    }

    public function checkBankBalanceBeforeIssuingAnyCheque()
    {
        $checkForAccess = DevUsageControlMeta::where('meta_key','check_bank_balance_before_issuing_any_cheque')->where('status','active')->first();
        $accessDays = $checkForAccess->meta_value ?? 0;
        return $accessDays;
    }
}

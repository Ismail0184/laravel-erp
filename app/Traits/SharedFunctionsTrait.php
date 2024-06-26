<?php

namespace App\Traits;

use App\Models\Developer\UsageControl\DevUsageControlMeta;
use Auth;

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

    public function checkLedgerBalanceBeforeMakingContra()
    {
        $checkForAccess = DevUsageControlMeta::where('meta_key','check_ledger_balance_before_making_contra')->where('status','active')->first();
        $accessDays = $checkForAccess->meta_value ?? 0;
        return $accessDays;
    }

    public function checkLedgerBalanceBeforeMakingJournal()
    {
        $checkForAccess = DevUsageControlMeta::where('meta_key','check_ledger_balance_before_making_journal')->where('status','active')->first();
        $accessKey = $checkForAccess->meta_value ?? 0;
        return $accessKey;
    }

    public function checkBankBalanceBeforeIssuingAnyCheque()
    {
        $checkForAccess = DevUsageControlMeta::where('meta_key','check_bank_balance_before_issuing_any_cheque')->where('status','active')->first();
        $accessDays = $checkForAccess->meta_value ?? 0;
        return $accessDays;
    }

    public function voucherNumberGenerate($voucherType)
    {
        $groupId = Auth::user()->group_id;
        $companyId = substr(Auth::user()->company_id,3);
        $generateVoucherNumber = $groupId.$companyId.Auth::user()->id.$voucherType.date('YmdHis');
        return $generateVoucherNumber;
    }

    public function transactionNumberGenerate()
    {
        $generateVoucherNumber = Auth::user()->id.date('YmdHis');
        return $generateVoucherNumber;
    }
}

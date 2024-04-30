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
}

<?php

namespace App\Models\HRM\employee;

use App\Models\HRM\setup\HrmBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEmployeeBankAccountInfo extends Model
{
    use HasFactory;

    public static $bank;

    public static function storeBankAccountInfo($request)
    {
        self::$bank = new HrmEmployeeBankAccountInfo();
        self::$bank->employee_id = $request->employee_id;
        self::$bank->bank_id = $request->bank_id;
        self::$bank->bank_account_number = $request->bank_account_number;
        self::$bank->bank_account_name = $request->bank_account_name;
        self::$bank->routing = $request->routing;
        self::$bank->entry_by = $request->entry_by;
        self::$bank->sconid = 1;
        self::$bank->pcomid = 1;
        self::$bank->save();
    }

    public static function destroyBankAccountInfo($id)
    {
        self::$bank = HrmEmployeeBankAccountInfo::findOrfail($id);
        self::$bank->delete();
    }

    public function bank()
    {
        return $this->belongsTo(HrmBank::class,'bank_id','id');
    }
}

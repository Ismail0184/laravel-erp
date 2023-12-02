<?php

namespace App\Models\HRM\payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmPayrollSalaryScale extends Model
{
    use HasFactory;

    public static $salaryScale;

    public static function storeSalaryScale($request)
    {
        self::$salaryScale = new HrmPayrollSalaryScale();
        self::$salaryScale->basic_amount = $request->basic_amount;
        self::$salaryScale->house_rent = $request->house_rent;
        self::$salaryScale->conveyance_bill = $request->conveyance_bill;
        self::$salaryScale->phone_bill = $request->phone_bill;
        self::$salaryScale->medical_allowance = $request->medical_allowance;
        self::$salaryScale->income_tax = $request->income_tax;
        self::$salaryScale->pf_amount = $request->pf_amount;
        self::$salaryScale->entry_by = $request->entry_by;
        self::$salaryScale->sconid = 1;
        self::$salaryScale->pcomid = 1;
        self::$salaryScale->save();
    }

    public static function destroySalaryScale($id)
    {
        self::$salaryScale = HrmPayrollSalaryScale::findOrfail($id);
        self::$salaryScale->delete();

    }
}

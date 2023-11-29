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
        self::$salaryScale->employee_id = $request->employee_id;
        self::$salaryScale->education_degree = $request->education_degree;
        self::$salaryScale->education_subject = $request->education_subject;
        self::$salaryScale->grade = $request->grade;
        self::$salaryScale->passing_year = $request->passing_year;
        self::$salaryScale->cgpa = $request->cgpa;
        self::$salaryScale->scale = $request->scale;
        self::$salaryScale->institute = $request->institute;
        self::$salaryScale->last_education = $request->last_education;
        self::$salaryScale->institute_type = $request->institute_type;
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

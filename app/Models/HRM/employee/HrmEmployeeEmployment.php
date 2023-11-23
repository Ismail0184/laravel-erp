<?php

namespace App\Models\HRM\employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEmployeeEmployment extends Model
{
    use HasFactory;

    public static $employment;

    public static function storeEmploymentInfo($request)
    {
        self::$employment = new HrmEmployeeEmployment();
        self::$employment->employee_id = $request->employee_id;
        self::$employment->company_name = $request->company_name;
        self::$employment->address = $request->address;
        self::$employment->job_title = $request->job_title;
        self::$employment->start_date = $request->start_date;
        self::$employment->end_date = $request->end_date;
        self::$employment->last_salary = $request->last_salary;
        self::$employment->exp_letter = $request->exp_letter;
        self::$employment->noc = $request->noc;
        self::$employment->remarks = $request->remarks;
        self::$employment->entry_by = $request->entry_by;
        self::$employment->sconid = 1;
        self::$employment->pcomid = 1;
        self::$employment->save();
    }

    public static function destroyEmploymentInfo($id)
    {
        self::$employment = HrmEmployeeEmployment::findOrfail($id);
        self::$employment->delete();

    }
}

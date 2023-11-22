<?php

namespace App\Models\HRM\employee;

use App\Models\HRM\setup\HrmRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEmployeeJobInfo extends Model
{
    use HasFactory;

    public static $employee;
    protected $primaryKey = 'employee_id';

    public static function storeJobInfo($request)
    {
        self::$employee = new HrmEmployeeJobInfo();
        self::$employee->employee_id = $request->employee_id;
        self::$employee->appointment_ref_no = $request->appointment_ref_no;
        self::$employee->appointment_date = $request->appointment_date;
        self::$employee->confirmation_date = $request->confirmation_date;
        self::$employee->joining_date = $request->joining_date;
        self::$employee->corporate_mobile = $request->corporate_mobile;
        self::$employee->corporate_email = $request->corporate_email;
        self::$employee->employment_type = $request->employment_type;
        self::$employee->job_location = $request->job_location;
        self::$employee->department = $request->department;
        self::$employee->designation = $request->designation;
        self::$employee->grade = $request->grade;
        self::$employee->shift = $request->shift;
        self::$employee->entry_by = $request->entry_by;
        self::$employee->sconid = 1;
        self::$employee->pcomid = 1;
        self::$employee->save();
    }

    public static function updateJobInfo($request, $id)
    {
        self::$employee = HrmEmployeeJobInfo::where('employee_id', $id)->firstOrfail();;
        self::$employee->appointment_ref_no = $request->appointment_ref_no;
        self::$employee->appointment_date = $request->appointment_date;
        self::$employee->confirmation_date = $request->confirmation_date;
        self::$employee->joining_date = $request->joining_date;
        self::$employee->corporate_mobile = $request->corporate_mobile;
        self::$employee->corporate_email = $request->corporate_email;
        self::$employee->employment_type = $request->employment_type;
        self::$employee->job_location = $request->job_location;
        self::$employee->department = $request->department;
        self::$employee->designation = $request->designation;
        self::$employee->grade = $request->grade;
        self::$employee->shift = $request->shift;
        self::$employee->entry_by = $request->entry_by;
        self::$employee->sconid = 1;
        self::$employee->pcomid = 1;
        self::$employee->updated_by = $request->entry_by;
        self::$employee->sconid = 1;
        self::$employee->pcomid = 1;
        self::$employee->save();
    }


}

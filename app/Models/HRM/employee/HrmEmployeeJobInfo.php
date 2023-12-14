<?php

namespace App\Models\HRM\employee;

use App\Models\HRM\setup\HrmDepartment;
use App\Models\HRM\setup\HrmDesignation;
use App\Models\HRM\setup\HrmEmploymentType;
use App\Models\HRM\setup\HrmGrade;
use App\Models\HRM\setup\HrmJobLocation;
use App\Models\HRM\setup\HrmRelation;
use App\Models\HRM\setup\HrmShift;
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
        self::$employee->updated_by = $request->entry_by;
        self::$employee->sconid = 1;
        self::$employee->pcomid = 1;
        self::$employee->save();
    }

    public function getDepartment()
    {
        return $this->belongsTo(HrmDepartment::class,'department','id');
    }
    public function getDesignation()
    {
        return $this->belongsTo(HrmDesignation::class,'designation','id');
    }

    public function employmentType()
    {
        return $this->belongsTo(HrmEmploymentType::class,'employment_type','id');
    }

    public function Grade()
    {
        return $this->belongsTo(HrmGrade::class,'grade','id');
    }

    public function Shift()
    {
        return $this->belongsTo(HrmShift::class,'shift','id');
    }

    public function jobLocation()
    {
        return $this->belongsTo(HrmJobLocation::class,'job_location','id');
    }

}

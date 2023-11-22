<?php

namespace App\Models\HRM\employee;

use App\Models\HRM\setup\HrmEduExamTitle;
use App\Models\HRM\setup\HrmUniversity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEmployeeEducationInfo extends Model
{
    use HasFactory;

    public static $employee;

    public static function storeEducationInfo($request)
    {
        self::$employee = new HrmEmployeeEducationInfo();
        self::$employee->employee_id = $request->employee_id;
        self::$employee->education_degree = $request->education_degree;
        self::$employee->grade = $request->grade;
        self::$employee->passing_year = $request->passing_year;
        self::$employee->cgpa = $request->cgpa;
        self::$employee->scale = $request->scale;
        self::$employee->institute = $request->institute;
        self::$employee->last_education = $request->last_education;
        self::$employee->institute_type = $request->institute_type;
        self::$employee->entry_by = $request->entry_by;
        self::$employee->sconid = 1;
        self::$employee->pcomid = 1;
        self::$employee->save();
    }

    public static function destroyEducationInfo($id)
    {
        self::$employee = HrmEmployeeEducationInfo::findOrfail($id);
        self::$employee->delete();

    }

    public function Courses()
    {
        return $this->belongsTo(HrmEduExamTitle::class,'education_degree','id');
    }

    public function institutes()
    {
        return $this->belongsTo(HrmUniversity::class,'institute','id');
    }
}

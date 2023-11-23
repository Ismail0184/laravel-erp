<?php

namespace App\Models\HRM\employee;

use App\Models\HRM\setup\HrmEduExamTitle;
use App\Models\HRM\setup\HrmUniversity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEmployeeEducationInfo extends Model
{
    use HasFactory;

    public static $educational;

    public static function storeEducationInfo($request)
    {
        self::$educational = new HrmEmployeeEducationInfo();
        self::$educational->employee_id = $request->employee_id;
        self::$educational->education_degree = $request->education_degree;
        self::$educational->grade = $request->grade;
        self::$educational->passing_year = $request->passing_year;
        self::$educational->cgpa = $request->cgpa;
        self::$educational->scale = $request->scale;
        self::$educational->institute = $request->institute;
        self::$educational->last_education = $request->last_education;
        self::$educational->institute_type = $request->institute_type;
        self::$educational->entry_by = $request->entry_by;
        self::$educational->sconid = 1;
        self::$educational->pcomid = 1;
        self::$educational->save();
    }

    public static function destroyEducationInfo($id)
    {
        self::$educational = HrmEmployeeEducationInfo::findOrfail($id);
        self::$educational->delete();

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

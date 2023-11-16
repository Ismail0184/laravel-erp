<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmGrade extends Model
{
    use HasFactory;

    public static $grade;

    public static function storeGrade($request)
    {
        self::$grade = new HrmGrade();
        self::$grade->grade = $request->grade;
        self::$grade->entry_by = $request->entry_by;
        self::$grade->sconid = 1;
        self::$grade->pcomid = 1;
        self::$grade->save();
    }
    public static function updateEmploymentType($request,$id)
    {
        self::$grade = HrmEmploymentType::findOrfail($id);
        self::$grade->grade = $request->grade;
        self::$grade->entry_by = $request->entry_by;
        self::$grade->status = $request->status;
        self::$grade->sconid = 1;
        self::$grade->pcomid = 1;
        self::$grade->save();
    }

    public static function destroyEmploymentType($id)
    {
        HrmEmploymentType::where('id',$id)->update(['status'=>'deleted']);
    }
}

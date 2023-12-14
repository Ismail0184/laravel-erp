<?php

namespace App\Models\HRM\setup;

use App\Models\HRM\employee\HrmEmployeeJobInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmDesignation extends Model
{
    use HasFactory;

    public static $designation;

    public static function storeDesignation($request)
    {
        self::$designation = new HrmDesignation();
        self::$designation->designation_name = $request->designation_name;
        self::$designation->designation_short_name = $request->designation_short_name;
        self::$designation->designation_grade = $request->designation_grade;
        self::$designation->entry_by = $request->entry_by;
        self::$designation->sconid = 1;
        self::$designation->pcomid = 1;
        self::$designation->save();

    }
    public static function updateDesignation($request,$id)
    {
        self::$designation = HrmDesignation::findOrfail($id);
        self::$designation->designation_name = $request->designation_name;
        self::$designation->designation_short_name = $request->designation_short_name;
        self::$designation->designation_grade = $request->designation_grade;
        self::$designation->status = $request->status;
        self::$designation->entry_by = $request->entry_by;
        self::$designation->sconid = 1;
        self::$designation->pcomid = 1;
        self::$designation->save();
    }

    public static function destroyDesignation($id)
    {
        return HrmDesignation::where('id',$id)->update(['status'=>'deleted']);
    }
}

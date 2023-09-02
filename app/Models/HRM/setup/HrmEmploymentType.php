<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEmploymentType extends Model
{
    use HasFactory;

    public static $et;

    public static function storeEmploymentType($request)
    {
        self::$et = new HrmEmploymentType();
        self::$et->employment_type_name = $request->employment_type_name;
        self::$et->entry_by = $request->entry_by;
        self::$et->sconid = 1;
        self::$et->pcomid = 1;
        self::$et->save();
    }
    public static function updateEmploymentType($request,$id)
    {
        self::$et = HrmEmploymentType::findOrfail($id);
        self::$et->employment_type_name = $request->employment_type_name;
        self::$et->entry_by = $request->entry_by;
        self::$et->status = $request->status;
        self::$et->sconid = 1;
        self::$et->pcomid = 1;
        self::$et->save();
    }

    public static function destroyEmploymentType($id)
    {
        HrmEmploymentType::where('id',$id)->update(['status'=>'deleted']);
    }
}

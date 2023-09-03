<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEduQualification extends Model
{
    use HasFactory;

    public static $eq;

    public static function storeEduQua($request)
    {
        self::$eq = new HrmEduQualification();
        self::$eq->name         = $request->name;
        self::$eq->short_name   = $request->short_name;
        self::$eq->entry_by     = $request->entry_by;
        self::$eq->sconid       = 1;
        self::$eq->pcomid       = 1;
        self::$eq->save();
    }

    public static function updateEduQua($request, $id)
    {
        self::$eq = HrmEduQualification::findOrfail($id);
        self::$eq->name         = $request->name;
        self::$eq->short_name   = $request->short_name;
        self::$eq->entry_by     = $request->entry_by;
        self::$eq->status     = $request->status;
        self::$eq->sconid       = 1;
        self::$eq->pcomid       = 1;
        self::$eq->save();
    }

    public static function destroyEduQua($id)
    {
        HrmEduQualification::where('id',$id)->update(['status'=>'deleted']);
    }
}

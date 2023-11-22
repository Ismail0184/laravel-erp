<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEduSubject extends Model
{
    use HasFactory;

    public static $eduSub;

    public static function storeEduSubject($request)
    {
        self::$eduSub = new HrmEduSubject();
        self::$eduSub->subject_name = $request->subject_name;
        self::$eduSub->entry_by = $request->entry_by;
        self::$eduSub->sconid = 1;
        self::$eduSub->pcomid = 1;
        self::$eduSub->save();
    }

    public static function updateEduSubject($request,$id)
    {
        self::$eduSub = HrmEduSubject::findOrfail($id);
        self::$eduSub->subject_name = $request->subject_name;
        self::$eduSub->status = $request->status;
        self::$eduSub->entry_by = $request->entry_by;
        self::$eduSub->sconid = 1;
        self::$eduSub->pcomid = 1;
        self::$eduSub->save();
    }
}

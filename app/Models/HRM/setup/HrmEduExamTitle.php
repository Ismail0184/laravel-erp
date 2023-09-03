<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEduExamTitle extends Model
{
    use HasFactory;

    public static $eet;

    public static function storeEduExamTitle($request)
    {
        self::$eet = new HrmEduExamTitle();
        self::$eet->exam_title = $request->exam_title;
        self::$eet->entry_by = $request->entry_by;
        self::$eet->sconid = 1;
        self::$eet->pcomid = 1;
        self::$eet->save();
    }

    public static function updateEduExamTitle($request, $id)
    {
        self::$eet = HrmEduExamTitle::findOrfail($id);
        self::$eet->exam_title = $request->exam_title;
        self::$eet->entry_by = $request->entry_by;
        self::$eet->status = $request->status;
        self::$eet->sconid = 1;
        self::$eet->pcomid = 1;
        self::$eet->save();
    }

    public static function destroyEduExamTitle($id)
    {
        HrmEduExamTitle::where('id',$id)->update(['status'=>'deleted']);
    }
}

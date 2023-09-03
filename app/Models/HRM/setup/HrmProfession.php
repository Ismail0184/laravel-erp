<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmProfession extends Model
{
    use HasFactory;

    public static $pt;

    public static function storeProfessionType($request)
    {
        self::$pt = new HrmProfession();
        self::$pt->profession_name = $request->profession_name;
        self::$pt->entry_by = $request->entry_by;
        self::$pt->sconid = 1;
        self::$pt->pcomid = 1;
        self::$pt->save();
    }

    public static function updateProfessionType($request)
    {
        self::$pt = new HrmProfession();
        self::$pt->profession_name = $request->profession_name;
        self::$pt->status = $request->status;
        self::$pt->entry_by = $request->entry_by;
        self::$pt->sconid = 1;
        self::$pt->pcomid = 1;
        self::$pt->save();
    }

    public static function destroyProfessionType($id)
    {
        HrmProfession::where('id',$id)->update(['status'=>'deleted']);
    }
}

<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmReligion extends Model
{
    use HasFactory;

    public static $religion;

    public static function storeReligion($request)
    {
        self::$religion = new HrmReligion();
        self::$religion->name = $request->name;
        self::$religion->entry_by = $request->entry_by;
        self::$religion->sconid = 1;
        self::$religion->pcomid = 1;
        self::$religion->save();
    }

    public static function updateReligion($request, $id)
    {
        self::$religion = HrmReligion::findOrfail($id);
        self::$religion->name = $request->name;
        self::$religion->status = $request->status;
        self::$religion->updated_by = $request->entry_by;
        self::$religion->sconid = 1;
        self::$religion->pcomid = 1;
        self::$religion->save();
    }

    public static function destroyReligion($id)
    {
        HrmReligion::where('id',$id)->update(['status'=>'deleted']);
    }
}

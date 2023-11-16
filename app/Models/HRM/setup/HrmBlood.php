<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmBlood extends Model
{
    use HasFactory;

    public static $blood;

    public static function storeBlood($request)
    {
        self::$blood = new HrmBlood();
        self::$blood->name = $request->name;
        self::$blood->entry_by = $request->entry_by;
        self::$blood->sconid = 1;
        self::$blood->pcomid = 1;
        self::$blood->save();
    }

    public static function updateBlood($request, $id)
    {
        self::$blood = HrmBlood::findOrfail($id);
        self::$blood->name = $request->name;
        self::$blood->status = $request->status;
        self::$blood->updated_by = $request->entry_by;
        self::$blood->sconid = 1;
        self::$blood->pcomid = 1;
        self::$blood->save();
    }

    public static function destroyBlood($id)
    {
        HrmBlood::where('id',$id)->update(['status'=>'deleted']);
    }
}

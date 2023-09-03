<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmTravelScope extends Model
{
    use HasFactory;

    public static $ts;

    public static function storeTravelScope($request)
    {
        self::$ts = new HrmTravelScope();
        self::$ts->travel_scope_name = $request->travel_scope_name;
        self::$ts->entry_by = $request->entry_by;
        self::$ts->sconid = 1;
        self::$ts->pcomid = 1;
        self::$ts->save();
    }

    public static function updateTravelScope($request, $id)
    {
        self::$ts = HrmTravelScope::findOrfail($id);
        self::$ts->travel_scope_name = $request->travel_scope_name;
        self::$ts->entry_by = $request->entry_by;
        self::$ts->sconid = 1;
        self::$ts->pcomid = 1;
        self::$ts->save();
    }

    public static function destroyTravelScope($id)
    {
        HrmTravelScope::where('id',$id)->update(['status'=>'deleted']);
    }
}

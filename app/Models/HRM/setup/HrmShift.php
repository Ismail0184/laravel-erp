<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmShift extends Model
{
    use HasFactory;
    public static $shift;

    public static function storeShift($request)
    {
        self::$shift = new HrmShift();
        self::$shift->shift_name = $request->shift_name;
        self::$shift->start_time = $request->start_time;
        self::$shift->end_time = $request->end_time;
        self::$shift->entry_by = $request->entry_by;
        self::$shift->sconid = 1;
        self::$shift->pcomid = 1;
        self::$shift->save();
    }
    public static function updateShift($request,$id)
    {
        self::$shift = HrmShift::findOrfail($id);
        self::$shift->shift_name = $request->shift_name;
        self::$shift->start_time = $request->start_time;
        self::$shift->end_time = $request->end_time;
        self::$shift->entry_by = $request->entry_by;
        self::$shift->status = $request->status;
        self::$shift->sconid = 1;
        self::$shift->pcomid = 1;
        self::$shift->save();
    }

    public static function destroyShift($id)
    {
        HrmShift::where('id',$id)->update(['status'=>'deleted']);
    }
}

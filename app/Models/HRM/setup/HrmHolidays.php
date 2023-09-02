<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class HrmHolidays extends Model
{
    use HasFactory;

    public static $holiday;

    public static function storeHoliday($request)
    {
        self::$holiday = new HrmHolidays();
        self::$holiday->holiday_date = $request->holiday_date;
        self::$holiday->reason = $request->reason;
        $date = Carbon::parse($request->holiday_date);
        self::$holiday->year = $date->year;
        self::$holiday->entry_by = $request->entry_by;
        self::$holiday->sconid = 1;
        self::$holiday->pcomid = 1;
        self::$holiday->save();
    }

    public static function updateHoliday($request, $id)
    {
        self::$holiday = HrmHolidays::findOrfail($id);
        self::$holiday->holiday_date = $request->holiday_date;
        self::$holiday->reason = $request->reason;
        $date = Carbon::parse($request->holiday_date);
        self::$holiday->year = $date->year;
        self::$holiday->status = $request->status;
        self::$holiday->entry_by = $request->entry_by;
        self::$holiday->sconid = 1;
        self::$holiday->pcomid = 1;
        self::$holiday->save();
    }

    public static function destroyHoliday($id)
    {
        HrmHolidays::where('id',$id)->update(['status'=>'deleted']);
    }
}

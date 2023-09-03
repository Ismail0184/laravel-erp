<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmTravelNature extends Model
{
    use HasFactory;

    public static $tn;

    public static function storeTravelNature($request)
    {
        self::$tn = new HrmTravelNature();
        self::$tn->travel_nature_name = $request->travel_nature_name;
        self::$tn->entry_by = $request->entry_by;
        self::$tn->sconid = 1;
        self::$tn->pcomid = 1;
        self::$tn->save();
    }

    public static function updateTravelNature($request, $id)
    {
        self::$tn = HrmTravelNature::findOrfail($id);
        self::$tn->travel_nature_name = $request->travel_nature_name;
        self::$tn->entry_by = $request->entry_by;
        self::$tn->status = $request->status;
        self::$tn->sconid = 1;
        self::$tn->pcomid = 1;
        self::$tn->save();
    }

    public static function destroyTravelNature($id)
    {
        HrmTravelNature::where('id',$id)->update(['status'=>'deleted']);
    }
}

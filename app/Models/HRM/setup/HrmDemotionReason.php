<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmDemotionReason extends Model
{
    use HasFactory;

    public static $dr;

    public static function storeDemotionReason($request)
    {
        self::$dr = new HrmDemotionReason();
        self::$dr->reason = $request->reason;
        self::$dr->entry_by = $request->entry_by;
        self::$dr->sconid = 1;
        self::$dr->pcomid = 1;
        self::$dr->save();
    }

    public static function updateDemotionReason($request,$id)
    {
        self::$dr = HrmDemotionReason::findOrfail($id);
        self::$dr->reason = $request->reason;
        self::$dr->entry_by = $request->entry_by;
        self::$dr->status = $request->status;
        self::$dr->sconid = 1;
        self::$dr->pcomid = 1;
        self::$dr->save();
    }

    public static function destroyDemotionReason($id)
    {
        HrmDemotionReason::where('id',$id)->update(['status'=>'deleted']);
    }
}

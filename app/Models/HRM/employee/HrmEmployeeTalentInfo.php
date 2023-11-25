<?php

namespace App\Models\HRM\employee;

use App\Models\HRM\setup\HrmTalent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEmployeeTalentInfo extends Model
{
    use HasFactory;

    public static $talent;

    public static function storeTalentInfo($request)
    {
        self::$talent = new HrmEmployeeTalentInfo();
        self::$talent->employee_id = $request->employee_id;
        self::$talent->talent_id = $request->talent_id;
        self::$talent->details = $request->details;
        self::$talent->entry_by = $request->entry_by;
        self::$talent->sconid = 1;
        self::$talent->pcomid = 1;
        self::$talent->save();
    }

    public static function destroyTalentInfo($id)
    {
        self::$talent = HrmEmployeeTalentInfo::findOrfail($id);
        self::$talent->delete();
    }

    public function getTalent()
    {
        return $this->belongsTo(HrmTalent::class,'talent_id','id');
    }
}

<?php

namespace App\Models\HRM\employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEmployeeSupervisorInfo extends Model
{
    use HasFactory;

    public static $supervisor;

    public static function storeSupervisorInfo($request)
    {
        self::$supervisor = new HrmEmployeeSupervisorInfo();
        self::$supervisor->employee_id = $request->employee_id;
        self::$supervisor->supervisor = $request->supervisor;
        self::$supervisor->level = $request->level;
        self::$supervisor->effective_date = $request->effective_date;
        self::$supervisor->entry_by = $request->entry_by;
        self::$supervisor->sconid = 1;
        self::$supervisor->pcomid = 1;
        self::$supervisor->save();
    }

    public static function destroySupervisorInfo($id)
    {
        self::$supervisor = HrmEmployeeSupervisorInfo::findOrfail($id);
        self::$supervisor->delete();
    }

    public function getSupervisor()
    {
        return $this->belongsTo(HrmEmployee::class,'supervisor','id');
    }
}

<?php

namespace App\Models\employeeAccess\attendance;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EaOutdoorDuty extends Model
{
    use HasFactory;

    public static $outdoorDutyApplication;

    public static function storeOutdoorDutyApplication($request)
    {
        self::$outdoorDutyApplication = new EaOutdoorDuty();
        self::$outdoorDutyApplication->employee_id = $request->employee_id;
        self::$outdoorDutyApplication->date = $request->date;
        self::$outdoorDutyApplication->reason = $request->reason;
        self::$outdoorDutyApplication->od_place = $request->od_place;
        self::$outdoorDutyApplication->responsible_person = $request->responsible_person;
        self::$outdoorDutyApplication->recommended_by = $request->recommended_by;
        self::$outdoorDutyApplication->approved_by = $request->approved_by;
        self::$outdoorDutyApplication->year = date('Y');
        self::$outdoorDutyApplication->sconid = 1;
        self::$outdoorDutyApplication->pcomid = 1;
        self::$outdoorDutyApplication->save();
    }

    public static function updateOutdoorDutyApplication($request, $id)
    {
        self::$outdoorDutyApplication = EaOutdoorDuty::findOrfail($id);
        self::$outdoorDutyApplication->employee_id = $request->employee_id;
        self::$outdoorDutyApplication->date = $request->date;
        self::$outdoorDutyApplication->date = $request->date;
        self::$outdoorDutyApplication->reason = $request->reason;
        self::$outdoorDutyApplication->od_place = $request->od_place;
        self::$outdoorDutyApplication->responsible_person = $request->responsible_person;
        self::$outdoorDutyApplication->recommended_by = $request->recommended_by;
        self::$outdoorDutyApplication->approved_by = $request->approved_by;
        self::$outdoorDutyApplication->year = date('Y');
        self::$outdoorDutyApplication->sconid = 1;
        self::$outdoorDutyApplication->pcomid = 1;
        self::$outdoorDutyApplication->save();
    }

    public function AppliedBy()
    {
        return $this->belongsTo(User::class,'employee_id','id');
    }

    public function responsiblePerson()
    {
        return $this->belongsTo(User::class,'responsible_person','id');
    }

    public function RecommendedPerson()
    {
        return $this->belongsTo(User::class,'recommended_by','id');
    }

    public function ApprovedPerson()
    {
        return $this->belongsTo(User::class,'approved_by','id');
    }

    public function GrantPerson()
    {
        return $this->belongsTo(User::class,'granted_by','id');
    }

    public static function sendOutdoorDutyApplication($request, $id)
    {
        EaOutdoorDuty::where('id',$id)->update(['status'=>$request->status]);
    }

    public static function destroyOutdoorDutyApplication($id)
    {
        EaOutdoorDuty::where('id',$id)->update(['status'=>'DELETED']);
    }
}

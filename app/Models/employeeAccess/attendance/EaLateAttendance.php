<?php

namespace App\Models\employeeAccess\attendance;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EaLateAttendance extends Model
{
    use HasFactory;

    public static $lateAttendanceApplication;

    public static function storeLateAttendanceApplication($request)
    {
        self::$lateAttendanceApplication = new EaLateAttendance();
        self::$lateAttendanceApplication->employee_id = $request->employee_id;
        self::$lateAttendanceApplication->date = $request->date;
        self::$lateAttendanceApplication->late_entry_at = $request->late_entry_at;
        self::$lateAttendanceApplication->late_reason = $request->late_reason;
        self::$lateAttendanceApplication->recommended_by = $request->recommended_by;
        self::$lateAttendanceApplication->approved_by = $request->approved_by;
        self::$lateAttendanceApplication->year = date('Y');
        self::$lateAttendanceApplication->sconid = 1;
        self::$lateAttendanceApplication->pcomid = 1;
        self::$lateAttendanceApplication->save();
    }

    public static function updateLateAttendanceApplication($request, $id)
    {
        self::$lateAttendanceApplication = EaLateAttendance::findOrfail($id);
        self::$lateAttendanceApplication->employee_id = $request->employee_id;
        self::$lateAttendanceApplication->date = $request->date;
        self::$lateAttendanceApplication->late_entry_at = $request->late_entry_at;
        self::$lateAttendanceApplication->late_reason = $request->late_reason;
        self::$lateAttendanceApplication->recommended_by = $request->recommended_by;
        self::$lateAttendanceApplication->approved_by = $request->approved_by;
        self::$lateAttendanceApplication->year = date('Y');
        self::$lateAttendanceApplication->sconid = 1;
        self::$lateAttendanceApplication->pcomid = 1;
        self::$lateAttendanceApplication->save();
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

    public static function sendLateAttendanceApplication($request, $id)
    {
        EaLateAttendance::where('id',$id)->update(['status'=>$request->status]);
    }

    public static function destroyLateAttendanceApplication($id)
    {
        EaLateAttendance::where('id',$id)->update(['status'=>'DELETED']);
    }
}

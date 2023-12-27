<?php

namespace App\Models\employeeAccess\attendance;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EaEarlyLeaveApplication extends Model
{
    use HasFactory;

    public static $earlyLeaveApplication;

    public static function storeEarlyLeaveApplication($request)
    {
        self::$earlyLeaveApplication = new EaEarlyLeaveApplication();
        self::$earlyLeaveApplication->employee_id = $request->employee_id;
        self::$earlyLeaveApplication->date = $request->date;
        self::$earlyLeaveApplication->departure_time = $request->departure_time;
        self::$earlyLeaveApplication->reason = $request->reason;

        self::$earlyLeaveApplication->responsible_person = $request->responsible_person;
        self::$earlyLeaveApplication->recommended_by = $request->recommended_by;
        self::$earlyLeaveApplication->approved_by = $request->approved_by;
        self::$earlyLeaveApplication->year = date('Y');
        self::$earlyLeaveApplication->sconid = 1;
        self::$earlyLeaveApplication->pcomid = 1;
        self::$earlyLeaveApplication->save();
    }

    public static function updateEarlyLeaveApplication($request, $id)
    {
        self::$earlyLeaveApplication = EaEarlyLeaveApplication::findOrfail($id);
        self::$earlyLeaveApplication->employee_id = $request->employee_id;
        self::$earlyLeaveApplication->date = $request->date;
        self::$earlyLeaveApplication->departure_time = $request->departure_time;
        self::$earlyLeaveApplication->reason = $request->reason;
        self::$earlyLeaveApplication->responsible_person = $request->responsible_person;
        self::$earlyLeaveApplication->recommended_by = $request->recommended_by;
        self::$earlyLeaveApplication->approved_by = $request->approved_by;
        self::$earlyLeaveApplication->save();
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

    public static function sendEarlyLeaveApplication($request, $id)
    {
        EaEarlyLeaveApplication::where('id',$id)->update(['status'=>$request->status]);
    }

    public static function destroyEarlyLeaveApplication($id)
    {
        EaEarlyLeaveApplication::where('id',$id)->update(
            [
                'status'=>'DELETED',
                'sent_at' => now()
            ]);
    }
}

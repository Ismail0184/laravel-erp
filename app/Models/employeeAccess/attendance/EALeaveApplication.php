<?php

namespace App\Models\employeeAccess\attendance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EALeaveApplication extends Model
{
    use HasFactory;

    public static $leaveApplication;

    public static function storeLeaveApplication($request)
    {
        self::$leaveApplication = new EALeaveApplication();
        self::$leaveApplication->employee_id = $request->employee_id;
        self::$leaveApplication->type = $request->type;
        self::$leaveApplication->start_date = $request->start_date;
        self::$leaveApplication->end_date = $request->end_date;
        self::$leaveApplication->total_days = $request->total_days;
        self::$leaveApplication->reason = $request->reason;
        self::$leaveApplication->responsible_person = $request->responsible_person;
        self::$leaveApplication->leave_address = $request->leave_address;
        self::$leaveApplication->leave_mobile_number = $request->leave_mobile_number;
        self::$leaveApplication->att_file = $request->att_file;
        self::$leaveApplication->recommended_by = $request->recommended_by;
        self::$leaveApplication->approved_by = $request->approved_by;
        self::$leaveApplication->sconid = 1;
        self::$leaveApplication->pcomid = 1;
        self::$leaveApplication->save();
    }

    public static function updateLeaveApplication($request, $id)
    {
        self::$leaveApplication = EALeaveApplication::findOrfail($id);
        self::$leaveApplication->employee_id = $request->employee_id;
        self::$leaveApplication->type = $request->type;
        self::$leaveApplication->start_date = $request->start_date;
        self::$leaveApplication->end_date = $request->end_date;
        self::$leaveApplication->total_days = $request->total_days;
        self::$leaveApplication->reason = $request->reason;
        self::$leaveApplication->responsible_person = $request->responsible_person;
        self::$leaveApplication->leave_address = $request->leave_address;
        self::$leaveApplication->leave_mobile_number = $request->leave_mobile_number;
        self::$leaveApplication->att_file = $request->att_file;
        self::$leaveApplication->recommended_by = $request->recommended_by;
        self::$leaveApplication->approved_by = $request->approved_by;
        self::$leaveApplication->sconid = 1;
        self::$leaveApplication->pcomid = 1;
        self::$leaveApplication->save();
    }
}

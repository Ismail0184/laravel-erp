<?php

namespace App\Models\HRM\setup;

use App\Models\employeeAccess\attendance\EALeaveApplication;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class HrmLeaveType extends Model
{
    use HasFactory;

    public static $lt;

    public static function storeLeaveType($request)
    {
        self::$lt = new HrmLeaveType();
        self::$lt->leave_type_name = $request->leave_type_name;
        self::$lt->yearly_leave_days = $request->yearly_leave_days;
        self::$lt->entry_by = $request->entry_by;
        self::$lt->sconid = 1;
        self::$lt->pcomid = 1;
        self::$lt->save();
    }
    public static function updateLeaveType($request, $id)
    {
        self::$lt = HrmLeaveType::findOrfail($id);
        self::$lt->leave_type_name = $request->leave_type_name;
        self::$lt->yearly_leave_days = $request->yearly_leave_days;
        self::$lt->entry_by = $request->entry_by;
        self::$lt->sconid = 1;
        self::$lt->pcomid = 1;
        self::$lt->save();
    }

    public static function destroyLeaveType($id)
    {
        HrmLeaveType::where('id',$id)->update(['status'=>'deleted']);
    }

    public function LeaveTaken()
    {
        return $this->hasMany(EaLeaveApplication::class,'type','id')->whereNotIn('status',['DELETED'])->where('employee_id',Auth::user()->id);
    }
    public function LeaveApplied()
    {
        return $this->hasMany(EaLeaveApplication::class,'type','id')->whereNotIn('status',['DELETED','GRANTED'])->where('employee_id',Auth::user()->id);
    }
    public function LeaveGranted()
    {
        return $this->hasMany(EaLeaveApplication::class,'type','id')->where('status','GRANTED')->where('employee_id',Auth::user()->id);
    }
}

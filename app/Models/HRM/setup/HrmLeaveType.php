<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

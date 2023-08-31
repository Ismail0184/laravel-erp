<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmDepartment extends Model
{
    use HasFactory;

    public static $department;

    public static function storeDepartment($request)
    {
        self::$department = new HrmDepartment();
        self::$department->serial = $request->serial;
        self::$department->department_name = $request->department_name;
        self::$department->department_short_name = $request->department_short_name;
        self::$department->entry_by = $request->entry_by;
        self::$department->sconid = 1;
        self::$department->pcomid = 1;
        self::$department->save();
    }

    public static function updateDepartment($request, $id)
    {
        self::$department = HrmDepartment::findOrfail($id);
        self::$department->serial = $request->serial;
        self::$department->department_name = $request->department_name;
        self::$department->department_short_name = $request->department_short_name;
        self::$department->entry_by = $request->entry_by;
        self::$department->status = $request->status;
        self::$department->sconid = 1;
        self::$department->pcomid = 1;
        self::$department->save();
    }

    public static function destroyDepartment($id)
    {
        return HrmDepartment::where('id',$id)->update(['status' => 'deleted']);
    }
}

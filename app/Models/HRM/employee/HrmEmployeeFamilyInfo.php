<?php

namespace App\Models\HRM\employee;

use App\Models\HRM\setup\HrmRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEmployeeFamilyInfo extends Model
{
    use HasFactory;

    public static $employee;

    public static function storeFamilyInfo($request)
    {
        self::$employee = new HrmEmployeeFamilyInfo();
        self::$employee->employee_id = $request->employee_id;
        self::$employee->name = $request->name;
        self::$employee->relationship = $request->relationship;
        self::$employee->nid = $request->nid;
        self::$employee->mobile = $request->mobile;
        self::$employee->email = $request->email;
        self::$employee->profession = $request->profession;
        self::$employee->entry_by = $request->entry_by;
        self::$employee->sconid = 1;
        self::$employee->pcomid = 1;
        self::$employee->save();
    }

    public static function familyInfoDestroy($id)
    {
        self::$employee = HrmEmployeeFamilyInfo::findOrfail($id);
        self::$employee->delete();

    }

    public function relationships()
    {
        return $this->belongsTo(HrmRelation::class,'relationship','id');
    }
}

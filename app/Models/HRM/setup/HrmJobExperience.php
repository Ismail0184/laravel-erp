<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmJobExperience extends Model
{
    use HasFactory;

    public static $je;

    public static function storeJobExperience($request)
    {
        self::$je = new HrmJobExperience();
        self::$je->job_experience_name = $request->job_experience_name;
        self::$je->entry_by = $request->entry_by;
        self::$je->sconid = 1;
        self::$je->pcomid = 1;
        self::$je->save();
    }

    public static function updateJobExperience($request, $id)
    {
        self::$je = HrmJobExperience::findOrfail($id);
        self::$je->job_experience_name = $request->job_experience_name;
        self::$je->entry_by = $request->entry_by;
        self::$je->status = $request->status;
        self::$je->sconid = 1;
        self::$je->pcomid = 1;
        self::$je->save();
    }

    public static function destroyJobExperience($id)
    {
        HrmJobExperience::where('id',$id)->update(['status'=>'deleted']);
    }
}

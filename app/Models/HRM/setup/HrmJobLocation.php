<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmJobLocation extends Model
{
    use HasFactory;

    public static $jl;

    public static function storeJobLocation($request)
    {
        self::$jl = new HrmJobLocation();
        self::$jl->job_location_name = $request->job_location_name;
        self::$jl->entry_by = $request->entry_by;
        self::$jl->sconid = 1;
        self::$jl->pcomid = 1;
        self::$jl->save();
    }

    public static function updateJobLocation($request, $id)
    {
        self::$jl = HrmJobLocation::findOrfail($id);
        self::$jl->job_location_name = $request->job_location_name;
        self::$jl->entry_by = $request->entry_by;
        self::$jl->status = $request->status;
        self::$jl->sconid = 1;
        self::$jl->pcomid = 1;
        self::$jl->save();
    }

    public static function destroyJobLocation($id)
    {
        HrmJobLocation::where('id',$id)->update(['status'=>'deleted']);
    }

}

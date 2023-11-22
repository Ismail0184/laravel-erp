<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmUniversity extends Model
{
    use HasFactory;

    public static $university;

    public static function storeUniversity($request)
    {
        self::$university = new HrmUniversity();
        self::$university->university_name = $request->university_name;
        self::$university->entry_by = $request->entry_by;
        self::$university->sconid = 1;
        self::$university->pcomid = 1;
        self::$university->save();
    }

    public static function updateUniversity($request, $id)
    {
        self::$university = HrmUniversity::findOrfail($id);
        self::$university->university_name = $request->university_name;
        self::$university->entry_by = $request->entry_by;
        self::$university->status = $request->status;
        self::$university->sconid = 1;
        self::$university->pcomid = 1;
        self::$university->save();
    }

    public static function destroyUniversity($id)
    {
        HrmUniversity::where('id',$id)->update(['status'=>'deleted']);
    }
}

<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEduSubject extends Model
{
    use HasFactory;

    public static $eduSub;

    public static function storeEduSubject($request)
    {
        self::$eduSub = new HrmEduSubject();
        self::$eduSub->subject_name = $request->subject_name;
        self::$eduSub->subject_name = $request->subject_name;
        self::$eduSub->subject_name = $request->subject_name;
        self::$eduSub->subject_name = $request->subject_name;

    }
}

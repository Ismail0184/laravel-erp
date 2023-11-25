<?php

namespace App\Models\HRM\employee;

use App\Models\HRM\setup\HrmSocialMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEmployeeSocialMediaInfo extends Model
{
    use HasFactory;

    public static $bank;

    public static function storeSocialMediaInfo($request)
    {
        self::$bank = new HrmEmployeeSocialMediaInfo();
        self::$bank->employee_id = $request->employee_id;
        self::$bank->social_media_id = $request->social_media_id;
        self::$bank->account_name = $request->account_name;
        self::$bank->account_url = $request->account_url;
        self::$bank->entry_by = $request->entry_by;
        self::$bank->sconid = 1;
        self::$bank->pcomid = 1;
        self::$bank->save();
    }

    public static function destroySocialMediaInfo($id)
    {
        self::$bank = HrmEmployeeSocialMediaInfo::findOrfail($id);
        self::$bank->delete();
    }

    public function socialMedia()
    {
        return $this->belongsTo(HrmSocialMedia::class,'social_media_id','id');
    }
}

<?php

namespace App\Models\MIS\PermissionMatrix\otherOptions;

use App\Models\Developer\Builder\DevBuilderOther;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MisUserPermissionMatrixOtherOptions extends Model
{
    use HasFactory;

    public static $otherOption;

    public static function storeUserOtherOptionPermission($request)
    {
        $selectedOptions = $request->input('other_option_id');
        foreach ($selectedOptions as $option) {
            self::$otherOption = new MisUserPermissionMatrixOtherOptions();
            self::$otherOption->other_option_id = $option;
            self::$otherOption->user_id = $request->user_id;
            self::$otherOption->permitted_by = $request->permitted_by;
            self::$otherOption->company_id = 2;
            self::$otherOption->group_id = 1;
            self::$otherOption->save();
        }
    }

    public static function updateOtherOptionPermission($request, $id)
    {
        MisUserPermissionMatrixOtherOptions::where('id',$id)->update(
            [
                'status'=>$request->status,
                'updated_at' => now()
            ]);
    }

    public function getOtherOptionData()
    {
        return $this->belongsTo(DevBuilderOther::class,'other_option_id','id');
    }
}

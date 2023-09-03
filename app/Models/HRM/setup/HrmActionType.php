<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmActionType extends Model
{
    use HasFactory;

    public static $at;

    public static function storeActionType($request)
    {
        self::$at = new HrmActionType();
        self::$at->action_type_name = $request->action_type_name;
        self::$at->effect = $request->effect;
        self::$at->entry_by = $request->entry_by;
        self::$at->sconid = 1;
        self::$at->pcomid = 1;
        self::$at->save();
    }

    public static function updateActionType($request, $id)
    {
        self::$at = HrmActionType::findOrfail($id);
        self::$at->action_type_name = $request->action_type_name;
        self::$at->effect = $request->effect;
        self::$at->status = $request->status;
        self::$at->entry_by = $request->entry_by;
        self::$at->sconid = 1;
        self::$at->pcomid = 1;
        self::$at->save();
    }

    public static function destroyActionType($id)
    {
        HrmActionType::where('id',$id)->update(['status'=>'deleted']);
    }
}

<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmRelation extends Model
{
    use HasFactory;

    public static $relation;

    public static function storeRelation($request)
    {
        self::$relation = new HrmRelation();
        self::$relation->relation_name = $request->relation_name;
        self::$relation->entry_by = $request->entry_by;
        self::$relation->sconid = 1;
        self::$relation->pcomid = 1;
        self::$relation->save();
    }

    public static function updateRelation($request, $id)
    {
        self::$relation = HrmRelation::findOrfail($id);
        self::$relation->relation_name = $request->relation_name;
        self::$relation->entry_by = $request->entry_by;
        self::$relation->status = $request->status;
        self::$relation->sconid = 1;
        self::$relation->pcomid = 1;
        self::$relation->save();
    }

    public static function destroyRelation($id)
    {
        HrmRelation::where('id',$id)->update(['status'=>'deleted']);
    }
}

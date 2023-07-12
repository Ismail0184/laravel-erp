<?php

namespace App\Models\Accounts\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccProductSubGroup extends Model
{
    use HasFactory;

    protected $primaryKey = 'sub_group_id';
    public static $subGroup;

    public static function storeSubGroup($request)
    {
        self::$subGroup = new AccProductSubGroup();
        self::$subGroup->group_id = $request->group_id;
        self::$subGroup->sub_group_name = $request->sub_group_name;
        self::$subGroup->status = 'active';
        self::$subGroup->entry_by = $request->entry_by;
        self::$subGroup->sconid = 1;
        self::$subGroup->pcomid = 1;
        self::$subGroup->save();
    }

    public static function updateSubGroup($request,$id)
    {
        self::$subGroup = AccProductSubGroup::find($id);
        self::$subGroup->sub_group_name = $request->sub_group_name;
        self::$subGroup->status = $request->status;
        self::$subGroup->entry_by = $request->entry_by;
        self::$subGroup->save();
    }

    public static function destroySubGroup($id)
    {
        self::$subGroup = AccProductSubGroup::find($id);
        self::$subGroup->status = 'deleted';
        self::$subGroup->save();
    }

    public function group()
    {
        return $this->belongsTo(AccProductGroup::class, 'group_id','group_id');
    }
}

<?php

namespace App\Models\Accounts\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccProductGroup extends Model
{
    use HasFactory;

    protected $primaryKey = 'group_id';
    public static $group;

    public static function storeProductGroup($request)
    {
        self::$group = new AccProductGroup();
        self::$group->group_name = $request->group_name;
        self::$group->entry_by = $request->entry_by;
        self::$group->status = 'active';
        self::$group->sconid = 1;
        self::$group->pcomid = 1;
        self::$group->save();
    }

    public static function updateProductGroup($request, $id)
    {
        self::$group = AccProductGroup::find($id);
        self::$group->group_name = $request->group_name;
        self::$group->status = $request->status;
        self::$group->save();
    }

    public static function destroyProductGroup($id)
    {
        self::$group = AccProductGroup::find($id);
        self::$group->status = 'deleted';
        self::$group->save();
    }
}

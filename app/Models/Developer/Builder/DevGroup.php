<?php

namespace App\Models\Developer\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevGroup extends Model
{
    use HasFactory;
    protected $primaryKey = 'group_id';

    public static $group;

    public static function storeGroup($request)
    {
        self::$group = new DevGroup();
        self::$group->group_id = $request->group_id;
        self::$group->group_name = $request->group_name;
        self::$group->address = $request->address;
        self::$group->website = $request->website;
        self::$group->save();
    }

    public static function updateGroup($request, $id)
    {
        self::$group = DevGroup::findOrfail($id);
        self::$group->group_name = $request->group_name;
        self::$group->address = $request->address;
        self::$group->website = $request->website;
        self::$group->status = $request->status;
        self::$group->save();
    }

    public static function destroyGroup($id)
    {
        DevGroup::where('group_id',$id)->update(['status'=>'deleted']);
    }
}

<?php

namespace App\Models\Developer\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevBuilderOther extends Model
{
    use HasFactory;

    public static $other;

    public static function storeOtherOption($request)
    {
        self::$other = new DevBuilderOther();
        self::$other->name = $request->name;
        self::$other->key = $request->key;
        self::$other->route = $request->route;
        self::$other->save();
    }

    public static function updateOtherOption($request, $id)
    {
        self::$other = DevBuilderOther::find($id);
        self::$other->name = $request->name;
        self::$other->key = $request->key;
        self::$other->route = $request->route;
        self::$other->save();
    }

    public static function destroyOtherOption($id)
    {
        DevBuilderOther::where('id',$id)->update(
            [
                'status'=>'deleted',
                'updated_at' => now()
            ]);
    }
}

<?php

namespace App\Models\Developer\UsageControl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevUsageControlMeta extends Model
{
    use HasFactory;

    public static $meta;

    public static function storeMetaData($request)
    {
        self::$meta = new DevUsageControlMeta();
        self::$meta->meta_name = $request->meta_name;
        self::$meta->meta_key = $request->meta_key;
        self::$meta->meta_value = $request->meta_value;
        self::$meta->company_id = 2;
        self::$meta->group_id = 1;
        self::$meta->save();
    }

    public static function updateMetaData($request,$id)
    {
        self::$meta = DevUsageControlMeta::findOrfail($id);
        self::$meta->meta_name = $request->meta_name;
        self::$meta->meta_key = $request->meta_key;
        self::$meta->meta_value = $request->meta_value;
        self::$meta->status = $request->status;
        self::$meta->company_id = 2;
        self::$meta->group_id = 1;
        self::$meta->save();
    }

    public static function destroyMetaData($id)
    {
        DevUsageControlMeta::where('id',$id)->update(
            [
                'status'=>'postpone',
                'updated_at' => now()
            ]);
    }
}

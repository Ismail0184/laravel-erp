<?php

namespace App\Models\Developer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevModule extends Model
{
    use HasFactory;

    protected $primaryKey = 'module_id';

    private static $module;

    public static function storeModule($request)
    {
        self::$module = new DevModule();
        self::$module->serial = $request->serial;
        self::$module->modulename = $request->modulename;
        self::$module->module_short_name = $request->module_short_name;
        self::$module->fa_icon = $request->fa_icon;
        self::$module->fa_icon_color = $request->fa_icon_color;
        self::$module->notification_type = $request->notification_type;
        self::$module->section_type = $request->section_type;
        self::$module->status = 1;
        self::$module->sconid = 1;
        self::$module->pcomid = 1;
        self::$module->save();
    }

    public static function updateModule($request, $id)
    {
        self::$module = DevModule::find($id);
        self::$module->serial = $request->serial;
        self::$module->modulename = $request->modulename;
        self::$module->module_short_name = $request->module_short_name;
        self::$module->fa_icon = $request->fa_icon;
        self::$module->fa_icon_color = $request->fa_icon_color;
        self::$module->notification_type = $request->notification_type;
        self::$module->section_type = $request->section_type;
        self::$module->status = 1;
        self::$module->sconid = 1;
        self::$module->pcomid = 1;
        self::$module->save();
    }

    public static function destroyModule($id)
    {
        self::$module = DevModule::find($id);
        self::$module->delete();
    }
}

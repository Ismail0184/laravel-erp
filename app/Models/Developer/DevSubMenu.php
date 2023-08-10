<?php

namespace App\Models\Developer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevSubMenu extends Model
{
    use HasFactory;

    protected $primaryKey = 'sub_menu_id';
    public static $submenu;

    public static function getModuleId($main_menu_id)
    {
        $module_id = DevMainMenu::where('main_menu_id', $main_menu_id)->value('module_id');
        return $module_id;
    }

    public static function storeSubMenu($request)
    {
        self::$submenu = new DevSubMenu();
        self::$submenu->sub_menu_id = $request->sub_menu_id;
        self::$submenu->serial = $request->serial;
        self::$submenu->sub_menu_name = $request->sub_menu_name;
        self::$submenu->sub_url = $request->sub_url;
        self::$submenu->faicon = $request->faicon;
        self::$submenu->main_menu_id = $request->main_menu_id;
        self::$submenu->module_id = self::getModuleId($request->main_menu_id);
        self::$submenu->status = 1;
        self::$submenu->sconid = 1;
        self::$submenu->pcomid = 1;
        self::$submenu->save();
    }

    public static function updateSubMenu($request,$id)
    {
        self::$submenu = DevSubMenu::find($id);
        self::$submenu->sub_menu_id = $request->sub_menu_id;
        self::$submenu->serial = $request->serial;
        self::$submenu->sub_menu_name = $request->sub_menu_name;
        self::$submenu->sub_url = $request->sub_url;
        self::$submenu->faicon = $request->faicon;
        self::$submenu->main_menu_id = $request->main_menu_id;
        self::$submenu->module_id = self::getModuleId($request->main_menu_id);
        self::$submenu->status = 1;
        self::$submenu->sconid = 1;
        self::$submenu->pcomid = 1;
        self::$submenu->save();
    }

    public static function destroySubMenu($id)
    {
        self::$submenu = DevSubMenu::find($id);
        self::$submenu->status = 'deleted';
        self::$submenu->save();
    }

    public function mainmenuforsubmenu()
    {
        return $this->belongsTo(DevMainMenu::class, 'main_menu_id');
    }
}

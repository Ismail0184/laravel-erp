<?php

namespace App\Models\Developer\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class DevMainMenu extends Model
{
    use HasFactory;

    protected $primaryKey = 'main_menu_id';
    private static $mainmenu;

    public function moduleGet()
    {
        return $this->belongsTo(DevModule::class, 'module_id');
    }

    public static function storeMainMenu($request)
    {
        self::$mainmenu = new DevMainMenu();
        self::$mainmenu->serial = $request->serial;
        self::$mainmenu->main_menu_name = $request->main_menu_name;
        self::$mainmenu->url = $request->url;
        self::$mainmenu->quick_access_url = $request->quick_access_url;
        self::$mainmenu->faicon = $request->faicon;
        self::$mainmenu->module_id = $request->module_id;
        self::$mainmenu->status = 1;
        self::$mainmenu->sconid = 1;
        self::$mainmenu->pcomid = 1;
        self::$mainmenu->save();
    }

    public static function updateMainMenu($request, $id)
    {
        self::$mainmenu = DevMainMenu::find($id);
        self::$mainmenu->serial = $request->serial;
        self::$mainmenu->main_menu_name = $request->main_menu_name;
        self::$mainmenu->url = $request->url;
        self::$mainmenu->quick_access_url = $request->quick_access_url;
        self::$mainmenu->faicon = $request->faicon;
        self::$mainmenu->module_id = $request->module_id;
        self::$mainmenu->status = $request->status;
        self::$mainmenu->sconid = 1;
        self::$mainmenu->pcomid = 1;
        self::$mainmenu->save();
    }

    public function getModuleInfo()
    {
        return $this->belongsTo(DevModule::class,'module_id','module_id');
    }

    public function subMenu()
    {
        return $this->hasMany(DevSubMenu::class, 'main_menu_id', 'main_menu_id')->where('module_id',\Session::get('module_id', 'module_id'))->where('status','active')->orderBy('serial');
    }


}

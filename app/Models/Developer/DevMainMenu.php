<?php

namespace App\Models\Developer;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevMainMenu extends Model
{
    use HasFactory;

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


}

<?php

namespace App\Models\MIS\PermissionMatrix\mainMenu;

use App\Models\Developer\Builder\DevMainMenu;
use App\Models\Developer\Builder\DevModule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MisUserPermissionMatrixMainMenu extends Model
{
    use HasFactory;

    public static $mainMenu;


    public static function storeUserMainMenuPermission($request)
    {
        $selectedOptions = $request->input('main_menu_id');
        foreach ($selectedOptions as $option) {
            self::$mainMenu = new MisUserPermissionMatrixMainMenu();
            self::$mainMenu->main_menu_id = $option;
            self::$mainMenu->user_id = $request->user_id;
            self::$mainMenu->permitted_by = $request->permitted_by;
            $getModule = DevMainMenu::find($option);
            self::$mainMenu->module_id = $getModule->module_id;
            self::$mainMenu->company_id = 2;
            self::$mainMenu->group_id = 1;
            self::$mainMenu->save();
        }
    }

    public static function updateMainMenuPermission($request, $id)
    {
        MisUserPermissionMatrixMainMenu::where('id',$id)->update(
            [
                'status'=>$request->status,
                'updated_at' => now()
            ]);
    }

    public function getMasterMenuInfo()
    {
        return $this->belongsTo(DevMainMenu::class,'main_menu_id','main_menu_id');
    }

    public function getModuleInfo()
    {
        return $this->belongsTo(DevModule::class,'module_id','module_id');
    }
}

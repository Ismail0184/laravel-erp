<?php

namespace App\Models\MIS\PermissionMatrix\subMenu;

use App\Models\Developer\DevMainMenu;
use App\Models\Developer\DevSubMenu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MisUserPermissionMatrixSubMenu extends Model
{
    use HasFactory;

    public static $subMenu;

    public static function storeUserSubMenuPermission($request)
    {
        $selectedOptions = $request->input('sub_menu_id');
        foreach ($selectedOptions as $option) {
            self::$subMenu = new MisUserPermissionMatrixSubMenu();
            self::$subMenu->sub_menu_id = $option;
            self::$subMenu->user_id = $request->user_id;
            self::$subMenu->permitted_by = $request->permitted_by;
            $getModule = DevSubMenu::find($option);
            self::$subMenu->main_menu_id =  $getModule->main_menu_id;
            self::$subMenu->module_id = $getModule->module_id;
            self::$subMenu->company_id = 2;
            self::$subMenu->group_id = 1;
            self::$subMenu->save();
        }
    }

    public static function updateSubMenuPermission($request, $id)
    {
        MisUserPermissionMatrixSubMenu::where('id',$id)->update(
            [
                'status'=>$request->status,
                'updated_at' => now()
            ]);
    }

    public function getSubMenuInfo()
    {
        return $this->belongsTo(DevSubMenu::class,'sub_menu_id','sub_menu_id');
    }

    public function getMasterMenuInfo()
    {
        return $this->belongsTo(DevMainMenu::class,'main_menu_id','main_menu_id');
    }
}

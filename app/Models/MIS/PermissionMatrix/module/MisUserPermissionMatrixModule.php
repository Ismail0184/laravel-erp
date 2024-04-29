<?php

namespace App\Models\MIS\PermissionMatrix\module;

use App\Models\Developer\Builder\DevModule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MisUserPermissionMatrixModule extends Model
{
    use HasFactory;

    public static $module;

    public static function storeUserModulePermission($request)
    {

        $selectedOptions = $request->input('module_id');

        foreach ($selectedOptions as $option) {
            self::$module = new MisUserPermissionMatrixModule();
            self::$module->module_id = $option;
            self::$module->company_id = 1;
            self::$module->user_id = $request->user_id;
            self::$module->permitted_by = $request->permitted_by;
            self::$module->group_id = 1;
            self::$module->save();

        }
    }


    public function getModuleData()
    {
        return $this->belongsTo(DevModule::class,'module_id','module_id');
    }

    public static function updateModulePermission($request, $id)
    {
        MisUserPermissionMatrixModule::where('id',$id)->update(
            [
                'status'=>$request->status,
                'updated_at' => now()
            ]);
    }
}

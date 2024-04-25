<?php

namespace App\Models\MIS\PermissionMatrix\warehouse;

use App\Models\Developer\DevCompany;
use App\Models\Warehouse\warehouse\WhWarehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MisUserPermissionMatrixWarehouse extends Model
{
    use HasFactory;

    public static $warehouse;

    public static function storeUserWarehousePermission($request)
    {
        $selectedOptions = $request->input('warehouse_id');
        foreach ($selectedOptions as $option) {
            self::$warehouse = new MisUserPermissionMatrixWarehouse();
            self::$warehouse->warehouse_id = $option;
            self::$warehouse->user_id = $request->user_id;
            self::$warehouse->permitted_by = $request->permitted_by;
            self::$warehouse->company_id = $request->company_id;
            self::$warehouse->group_id = $request->group_id;
            self::$warehouse->save();
        }
    }

    public static function updateWarehousePermission($request, $id)
    {
        MisUserPermissionMatrixWarehouse::where('id',$id)->update(
            [
                'status'=>$request->status,
                'updated_at' => now()
            ]);
    }

    public function getWarehouseInfo()
    {
        return $this->belongsTo(WhWarehouse::class,'warehouse_id','warehouse_id');
    }

    public function getCompanyInfo()
    {
        return $this->belongsTo(DevCompany::class,'company_id','id');
    }
}

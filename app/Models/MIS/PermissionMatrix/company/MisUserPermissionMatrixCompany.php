<?php

namespace App\Models\MIS\PermissionMatrix\company;

use App\Models\Developer\Builder\DevCompany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MisUserPermissionMatrixCompany extends Model
{
    use HasFactory;

    public static $company;

    public static function getGid($company_id)
    {
        $company = DevCompany::findOrfail($company_id);
        return $company->group_id;
    }

    public static function storeUserCompanyPermission($request)
    {
        self::$company = new MisUserPermissionMatrixCompany();
        self::$company->company_id = $request->company_id;
        self::$company->user_id = $request->user_id;
        self::$company->permitted_by = $request->permitted_by;
        self::$company->default_company = $request->default_company ?? 0;
        self::$company->group_id = self::getGid($request->company_id);
        self::$company->save();
    }



    public function getComData()
    {
        return $this->belongsTo(DevCompany::class,'company_id','id');
    }

    public static function updateCompanyPermission($request, $id)
    {
        MisUserPermissionMatrixCompany::where('id',$id)->update(
            [
                'status'=>$request->status,
                'updated_at' => now()
            ]);
    }
}

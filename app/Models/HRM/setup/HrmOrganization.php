<?php

namespace App\Models\HRM\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmOrganization extends Model
{
    use HasFactory;

    public static $organization;

    public static function storeOrganization($request)
    {
        self::$organization = new HrmOrganization();
        self::$organization->organization_name = $request->organization_name;
        self::$organization->entry_by = $request->entry_by;
        self::$organization->sconid = 1;
        self::$organization->pcomid = 1;
        self::$organization->save();
    }

    public static function updateOrganization($request, $id)
    {
        self::$organization = HrmOrganization::findOrfail($id);
        self::$organization->organization_name = $request->organization_name;
        self::$organization->entry_by = $request->entry_by;
        self::$organization->status = $request->status;
        self::$organization->sconid = 1;
        self::$organization->pcomid = 1;
        self::$organization->save();
    }

    public static function destroyOrganization($id)
    {
        HrmOrganization::where('id',$id)->update(['status'=>'deleted']);
    }
}

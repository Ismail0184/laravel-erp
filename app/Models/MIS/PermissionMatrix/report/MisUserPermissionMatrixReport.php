<?php

namespace App\Models\MIS\PermissionMatrix\report;

use App\Models\Developer\DevCompany;
use App\Models\Developer\DevModule;
use App\Models\Developer\Reports\DevRepoptGroupLabel;
use App\Models\Developer\Reports\DevReport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MisUserPermissionMatrixReport extends Model
{
    use HasFactory;

    public static $reports;

    public static function storeUserReportPermission($request)
    {
        $selectedOptions = $request->input('report_id');
        foreach ($selectedOptions as $option) {
            self::$reports = new MisUserPermissionMatrixReport();
            self::$reports->report_id = $option;
            $getOptgroupLabel = DevReport::find($option);
            self::$reports->optgroup_label_id = $getOptgroupLabel->optgroup_label_id;
            self::$reports->user_id = $request->user_id;
            self::$reports->permitted_by = $request->permitted_by;
            self::$reports->module_id = $request->module_id;
            self::$reports->company_id = $request->company_id;
            $getGroupId = DevCompany::findOrfail($request->company_id);
            self::$reports->group_id = $getGroupId->group_id;
            self::$reports->save();
        }
    }

    public static function updateReportPermission($request, $id)
    {
        MisUserPermissionMatrixReport::where('id',$id)->update(
            [
                'status'=>$request->status,
                'updated_at' => now()
            ]);
    }

    public function getReportInfo()
    {
        return $this->belongsTo(DevReport::class,'report_id');
    }

    public function getReportLevelInfo()
    {
        return $this->belongsTo(DevRepoptGroupLabel::class,'optgroup_label_id');
    }

    public function getModuleInfo()
    {
        return $this->belongsTo(DevModule::class,'module_id');
    }

    public function getCompanyInfo()
    {
        return $this->belongsTo(DevCompany::class,'company_id');
    }
}

<?php

namespace App\Models\Developer\Reports;

use App\Models\Developer\Builder\DevModule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevRepoptGroupLabel extends Model
{
    use HasFactory;

    protected $primaryKey = 'optgroup_label_id';
    public static $reportLabel;

    public static function storeReportLabel($request)
    {
        self::$reportLabel = new DevRepoptGroupLabel();
        self::$reportLabel->serial = $request->serial;
        self::$reportLabel->optgroup_label_id = $request->optgroup_label_id;
        self::$reportLabel->optgroup_label_name = $request->optgroup_label_name;
        self::$reportLabel->module_id = $request->module_id;
        self::$reportLabel->status = 'active';
        self::$reportLabel->company_id = 2;
        self::$reportLabel->group_id = 1;
        self::$reportLabel->save();
    }

    public static function updateReportLabel($request, $id)
    {
        self::$reportLabel = DevRepoptGroupLabel::findOrfail($id);
        self::$reportLabel->serial = $request->serial;
        self::$reportLabel->optgroup_label_id = $request->optgroup_label_id;
        self::$reportLabel->optgroup_label_name = $request->optgroup_label_name;
        self::$reportLabel->module_id = $request->module_id;
        self::$reportLabel->status = $request->status;
        self::$reportLabel->save();
    }

    public static function destroyReportLabel($id)
    {
        DevRepoptGroupLabel::where('optgroup_label_id',$id)->update(
            [
                'status'=>'deleted',
                'updated_at' => now()
            ]);
    }

    public function reports()
    {
        return $this->hasMany(DevReport::class,'optgroup_label_id','optgroup_label_id');
    }

    public function getModuleInfo()
    {
        return $this->belongsTo(DevModule::class,'module_id','module_id');
    }
}

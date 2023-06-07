<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccCostCenter extends Model
{
    use HasFactory;
    protected $primaryKey = 'cc_code';

    public static $costcenter;

    public static function storeCostCenter($request)
    {
        self::$costcenter = new AccCostCenter();
        self::$costcenter->center_name = $request->center_name;
        self::$costcenter->category_id = $request->category_id;
        self::$costcenter->status = 'active';
        self::$costcenter->sconid = '1';
        self::$costcenter->pcomid = '1';
        self::$costcenter->entry_by = $request->entry_by;
        self::$costcenter->update_by = 0;
        self::$costcenter->save();
    }

    public static function updateCostCenter($request, $id)
    {
        self::$costcenter =  AccCostCenter::find($id);
        self::$costcenter->center_name = $request->center_name;
        self::$costcenter->category_id = $request->category_id;
        self::$costcenter->status = $request->status;
        self::$costcenter->update_by = $request->entry_by;
        self::$costcenter->save();
    }

    public static function destroyCostCenter($id)
    {
        self::$costcenter = AccCostCenter::find($id);
        self::$costcenter->status = 'deleted';
        self::$costcenter->save();
    }

    public function costcategoryforcostcenter()
    {
        return $this->belongsTo(AccCostCategory::class, 'category_id','id');
    }
}

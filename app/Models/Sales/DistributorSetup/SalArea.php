<?php

namespace App\Models\Sales\DistributorSetup;

use App\Models\Sales\DistributionSetup\SalRegion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalArea extends Model
{
    use HasFactory;
    protected $primaryKey = 'area_id';

    public static $area;

    public static function storeArea($request)
    {
        self::$area = new SalArea();
        self::$area->serial = $request->serial;
        self::$area->area_name = $request->area_name;
        self::$area->region_id = $request->region_id;
        self::$area->in_charge_person = $request->in_charge_person;
        self::$area->status = 'active';
        self::$area->entry_by = $request->entry_by;
        self::$area->sconid = '1';
        self::$area->pcomid = '1';
        self::$area->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'in_charge_person','id');
    }
    public function region()
    {
        return $this->belongsTo(SalRegion::class,'region_id','region_id');
    }
}

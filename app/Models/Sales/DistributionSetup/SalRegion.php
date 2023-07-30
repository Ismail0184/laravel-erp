<?php

namespace App\Models\Sales\DistributionSetup;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalRegion extends Model
{
    use HasFactory;
    protected $primaryKey = 'region_id';

    public static $region;

    public static function storeRegion($request)
    {
        self::$region = new SalRegion();
        self::$region->region_name      = $request->region_name;
        self::$region->in_charge_person = $request->in_charge_person;
        self::$region->status           = 'active';
        self::$region->entry_by         = $request->entry_by;
        self::$region->sconid           = 1;
        self::$region->pcomid           = 1;
        self::$region->save();
    }

    public static function updateRegion($request, $id)
    {
        self::$region = SalRegion::find($id);
        self::$region->region_name      = $request->region_name;
        self::$region->in_charge_person = $request->in_charge_person;
        self::$region->status           = $request->status;
        self::$region->entry_by         = $request->entry_by;
        self::$region->sconid           = 1;
        self::$region->pcomid           = 1;
        self::$region->save();
    }

    public static function destroyRegion($id)
    {
        self::$region = SalRegion::find($id);
        self::$region->status           = 'deleted';
        self::$region->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'in_charge_person','id');
    }
}

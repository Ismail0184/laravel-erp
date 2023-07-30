<?php

namespace App\Models\Sales\DistributionSetup;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalTerritory extends Model
{
    use HasFactory;
    protected $primaryKey = 'territory_id';
    public static $territory;

    public static function storeTerritory($request)
    {
        self::$territory = new SalTerritory();
        self::$territory->serial = $request->serial;
        self::$territory->territory_name = $request->territory_name;
        self::$territory->area_id = $request->area_id;
        self::$territory->in_charge_person = $request->in_charge_person;
        self::$territory->status = 'active';
        self::$territory->entry_by = $request->entry_by;
        self::$territory->sconid = 1;
        self::$territory->pcomid = 1;
        self::$territory->save();
    }

    public static function updateTerritory($request, $id)
    {
        self::$territory = SalTerritory::findorfail($id);
        self::$territory->serial = $request->serial;
        self::$territory->territory_name = $request->territory_name;
        self::$territory->area_id = $request->area_id;
        self::$territory->in_charge_person = $request->in_charge_person;
        self::$territory->status = $request->status;
        self::$territory->entry_by = $request->entry_by;
        self::$territory->sconid = 1;
        self::$territory->pcomid = 1;
        self::$territory->save();
    }

    public static function destroyTerritory($id)
    {
        self::$territory = SalTerritory::findorfail($id);
        self::$territory->status = 'deleted';
        self::$territory->save();
    }

    public function area()
    {
        return $this->belongsTo(SalArea::class,'area_id','area_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'in_charge_person','id');
    }
}

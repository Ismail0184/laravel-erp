<?php

namespace App\Models\Sales\DistributionSetup;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalTown extends Model
{
    use HasFactory;
    protected $primaryKey = 'town_id';

    public static $town;

    public static function storeTown($request)
    {
        self::$town = new SalTown();
        self::$town->serial = $request->serial;
        self::$town->town_name = $request->town_name;
        self::$town->territory_id = $request->territory_id;
        self::$town->in_charge_person = $request->in_charge_person;
        self::$town->status = 'active';
        self::$town->entry_by = $request->entry_by;
        self::$town->sconid = 1;
        self::$town->pcomid = 1;
        self::$town->save();
    }

    public static function updateTown($request,$id)
    {
        self::$town = SalTown::findOrFail($id);
        self::$town->serial = $request->serial;
        self::$town->town_name = $request->town_name;
        self::$town->territory_id = $request->territory_id;
        self::$town->in_charge_person = $request->in_charge_person;
        self::$town->status = $request->status;
        self::$town->entry_by = $request->entry_by;
        self::$town->sconid = 1;
        self::$town->pcomid = 1;
        self::$town->save();
    }

    public static function destroyTown($id)
    {
        self::$town = SalTown::findOrFail($id);
        self::$town->status = 'deleted';
        self::$town->save();
    }

    public function territory()
    {
        return $this->belongsTo(SalTerritory::class, 'territory_id','territory_id');
    }

    public function user()
    {
        return$this->belongsTo(User::class,'in_charge_person','id');
    }
}

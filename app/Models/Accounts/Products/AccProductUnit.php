<?php

namespace App\Models\Accounts\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccProductUnit extends Model
{
    use HasFactory;
    protected $primaryKey = 'unit_id';
    public static $unit;

    public static function storeUnit($request)
    {
        self::$unit = new AccProductUnit();
        self::$unit->unit_name = $request->unit_name;
        self::$unit->unit_detail = $request->unit_detail;
        self::$unit->status = 'active';
        self::$unit->entry_by = $request->entry_by;
        self::$unit->sconid = 1;
        self::$unit->pcomid = 1;
        self::$unit->save();
    }

    public static function updateUnit($request, $id)
    {
        self::$unit = AccProductUnit::find($id);
        self::$unit->unit_name = $request->unit_name;
        self::$unit->unit_detail = $request->unit_detail;
        self::$unit->status = $request->status;
        self::$unit->entry_by = $request->entry_by;
        self::$unit->save();
    }

    public static function destroyUnit($id)
    {
        self::$unit = AccProductUnit::find($id);
        self::$unit->status = 'deleted';
        self::$unit->save();
    }

}

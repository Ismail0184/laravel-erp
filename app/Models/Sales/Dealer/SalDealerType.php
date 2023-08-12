<?php

namespace App\Models\Sales\Dealer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalDealerType extends Model
{
    use HasFactory;
    protected $primaryKey = 'type_id';

    public static $type;

    public static function storeType($request)
    {
        self::$type = new SalDealerType();
        self::$type->type_name  = $request->type_name;
        self::$type->status     = 'active';
        self::$type->entry_by     = $request->entry_by;
        self::$type->sconid     = '1';
        self::$type->pcomid     = '1';
        self::$type->save();
    }

    public static function updateType($request,$id)
    {
        self::$type = SalDealerType::find($id);
        self::$type->type_name  = $request->type_name;
        self::$type->status     = 'active';
        self::$type->entry_by     = $request->entry_by;
        self::$type->sconid     = '1';
        self::$type->pcomid     = '1';
        self::$type->save();
    }

    public static function destroyDealerType($id)
    {
        SalDealerType::where('type_id',$id)->update(['status'=>'deleted']);
    }
}

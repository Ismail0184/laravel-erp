<?php

namespace App\Models\Procurement\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProVendorType extends Model
{
    use HasFactory;

    public static $type;

    public static function storeType($request)
    {
        self::$type = new ProVendorType();
        self::$type->vendor_type = $request->vendor_type;
        self::$type->status = 'active';
        self::$type->entry_by = $request->entry_by;
        self::$type->sconid = 1;
        self::$type->pcomid = 1;
        self::$type->save();
    }

    public static function updateType($request, $id)
    {
        self::$type = ProVendorType::find($id);
        self::$type->vendor_type = $request->vendor_type;
        self::$type->status = $request->status;
        self::$type->entry_by = $request->entry_by;
        self::$type->sconid = 1;
        self::$type->pcomid = 1;
        self::$type->save();
    }

    public static function destroyType($id)
    {
        self::$type = ProVendorType::find($id);
        self::$type->status = 'deleted';
        self::$type->save();
    }
}

<?php

namespace App\Models\Accounts\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccProductBrand extends Model
{
    use HasFactory;
    protected $primaryKey = 'brand_id';

    public static $brand;

    public static function storeBrand($request)
    {
        self::$brand = new AccProductBrand();
        self::$brand->brand_name = $request->brand_name;
        self::$brand->vendor_id = $request->vendor_id;
        self::$brand->status = 'active';
        self::$brand->entry_by = $request->entry_by;
        self::$brand->sconid = 1;
        self::$brand->pcomid = 1;
        self::$brand->save();
    }

    public static function updateBrand($request, $id)
    {
        self::$brand = AccProductBrand::find($id);
        self::$brand->brand_name = $request->brand_name;
        self::$brand->vendor_id = $request->vendor_id;
        self::$brand->status = $request->status;
        self::$brand->entry_by = $request->entry_by;
        self::$brand->save();
    }
    public static function destroyBrand($id)
    {
        self::$brand = AccProductBrand::find($id);
        self::$brand->status = 'deleted';
        self::$brand->save();
    }
}

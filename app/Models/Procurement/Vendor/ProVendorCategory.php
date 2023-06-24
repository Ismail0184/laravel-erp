<?php

namespace App\Models\Procurement\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProVendorCategory extends Model
{
    use HasFactory;

    public static $category;

    public static function storeCategory($request)
    {
        self::$category = new ProVendorCategory();
        self::$category->type_id = $request->type_id;
        self::$category->category_name = $request->category_name;
        self::$category->status = 'active';
        self::$category->entry_by = $request->entry_by;
        self::$category->sconid = 1;
        self::$category->pcomid = 1;
        self::$category->save();
    }

    public static function updateCategory($request, $id)
    {
        self::$category = ProVendorCategory::find($id);
        self::$category->type_id = $request->type_id;
        self::$category->category_name = $request->category_name;
        self::$category->status = $request->status;
        self::$category->entry_by = $request->entry_by;
        self::$category->save();
    }

    public static function destroyCategory($id)
    {
        self::$category = ProVendorCategory::find($id);
        self::$category->status = 'deleted';
        self::$category->save();
    }

    public function getType()
    {
        return $this->belongsTo(ProVendorType::class,'type_id','id');
    }
}

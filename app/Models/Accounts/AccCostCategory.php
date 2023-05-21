<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccCostCategory extends Model
{
    use HasFactory;

    public static $costcategory;

    public static function storeCostCategory($request)
    {
        self::$costcategory = new AccCostCategory();
        self::$costcategory->category_name = $request->category_name;
        self::$costcategory->status = 1;
        self::$costcategory->sconid = '1';
        self::$costcategory->pcomid = '1';
        self::$costcategory->entry_by = $request->entry_by;
        self::$costcategory->save();
    }

    public static function updateCostCategory($request, $id)
    {
        self::$costcategory = AccCostCategory::find($id);
        self::$costcategory->category_name = $request->category_name;
        self::$costcategory->status = $request->status;;
        self::$costcategory->sconid = '1';
        self::$costcategory->pcomid = '1';
        self::$costcategory->entry_by = $request->entry_by;
        self::$costcategory->save();
    }

    public static function destroyCostCategory($id)
    {
        self::$costcategory = AccCostCategory::find($id);
        self::$costcategory->delete();
    }

}

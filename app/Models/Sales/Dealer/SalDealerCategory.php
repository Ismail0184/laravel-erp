<?php

namespace App\Models\Sales\Dealer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalDealerCategory extends Model
{
    use HasFactory;
    protected $primaryKey = 'cat_id';
    public static $category;

    public static function storeDealerCategory($request)
    {
        self::$category                 = new SalDealerCategory();
        self::$category->category_name  = $request->category_name;
        self::$category->status         = 'active';
        self::$category->entry_by       = $request->entry_by;
        self::$category->sconid         = 1;
        self::$category->pcomid         = 1;
        self::$category->save();
    }

    public static function updateDealerCategory($request,$id)
    {
        self::$category                 = SalDealerCategory::find($id);
        self::$category->category_name  = $request->category_name;
        self::$category->status         = $request->status;
        self::$category->entry_by       = $request->entry_by;
        self::$category->sconid         = 1;
        self::$category->pcomid         = 1;
        self::$category->save();
    }

    public static function destroyDealerCategory($id)
    {
        SalDealerCategory::where('cat_id',$id)->update(['status'=>'deleted']);
    }
}

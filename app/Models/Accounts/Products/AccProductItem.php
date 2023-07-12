<?php

namespace App\Models\Accounts\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccProductItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'item_id';

    public static $item;

    public static function storeItem($request)
    {
        self::$item = new AccProductItem();
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->item_name = $request->item_name;
        self::$item->save();
    }
}

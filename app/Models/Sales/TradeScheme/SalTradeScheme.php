<?php

namespace App\Models\Sales\TradeScheme;

use App\Models\Accounts\Products\AccProductItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalTradeScheme extends Model
{
    use HasFactory;

    public static $ts;

    public static function storeTS($request)
    {
        self::$ts = new SalTradeScheme();
        self::$ts->offer_name = $request->offer_name;
        self::$ts->buy_item_id = $request->buy_item_id;
        self::$ts->buy_item_qty = $request->buy_item_qty;
        self::$ts->gift_item_id = $request->gift_item_id;
        self::$ts->gift_item_qty = $request->gift_item_qty;
        self::$ts->start_date = $request->start_date;
        self::$ts->end_date = $request->end_date;
        self::$ts->status = 'active';
        self::$ts->calculation_mode = $request->calculation_mode;
        self::$ts->gift_type = $request->gift_type;
        self::$ts->dealer_type = $request->dealer_type;
        self::$ts->entry_by = $request->entry_by;
        self::$ts->sconid = 1;
        self::$ts->pcomid = 1;
        self::$ts->save();
    }


    public function buyitem()
    {
        return $this->belongsTo(AccProductItem::class,'buy_item_id','item_id');
    }

    public function giftItem()
    {
        return $this->belongsTo(AccProductItem::class,'gift_item_id','item_id');
    }
}

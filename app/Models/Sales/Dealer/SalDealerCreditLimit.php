<?php

namespace App\Models\Sales\Dealer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalDealerCreditLimit extends Model
{
    use HasFactory;

    public static $cl;

    public static function storeCreditLimit($request)
    {
        self::$cl = new SalDealerCreditLimit();
        self::$cl->dealer_id = $request->dealer_id;
        self::$cl->current_balance = 1;
        self::$cl->requested_limit = $request->requested_limit;
        self::$cl->approved_limit = 0;
        self::$cl->remarks = $request->remarks;
        self::$cl->status = 'UNAPPROVED';
        self::$cl->limit_type = $request->limit_type;
        self::$cl->entry_by = $request->entry_by;
        self::$cl->sconid = 1;
        self::$cl->pcomid = 1;
        self::$cl->save();
    }

    public static function updateCreditLimit($request, $id)
    {
        self::$cl = SalDealerCreditLimit::findOrfail($id);
        self::$cl->dealer_id = $request->dealer_id;
        self::$cl->current_balance = 1;
        self::$cl->requested_limit = $request->requested_limit;
        self::$cl->approved_limit = 0;
        self::$cl->remarks = $request->remarks;
        self::$cl->status = 'UNAPPROVED';
        self::$cl->limit_type = $request->limit_type;
        self::$cl->entry_by = $request->entry_by;
        self::$cl->sconid = 1;
        self::$cl->pcomid = 1;
        self::$cl->save();
    }

    public static function destroyCreditLimit($id)
    {
        SalDealerCreditLimit::where('id',$id)->update(['status'=>'DELETED']);
    }

    public function dealer()
    {
        return $this->belongsTo(SalDealerInfo::class,'dealer_id','dealer_id');
    }
}

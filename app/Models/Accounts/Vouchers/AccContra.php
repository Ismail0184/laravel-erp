<?php

namespace App\Models\Accounts\Vouchers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class AccContra extends Model
{
    use HasFactory;

    private static $contra;

    public static function addContraData($request)
    {
        self::$contra = new AccContra();
        self::$contra->journal_no = $request->journal_no;
        self::$contra->journal_date = $request->journal_date;
        self::$contra->narration = $request->narration;
        self::$contra->ledger_id = $request->ledger_id;
        self::$contra->relevant_cash_head = $request->relevant_cash_head;
        if($request->dr_amt>0 && $request->cr_amt=='') {
            self::$contra->dr_amt = $request->dr_amt;
            self::$contra->cr_amt = 0;
        } elseif ($request->cr_amt>0 && $request->dr_amt==''){
            self::$contra->dr_amt = 0;
            self::$contra->cr_amt = $request->cr_amt;
        }
        self::$contra->cc_code = $request->cc_code;
        self::$contra->status = 'MANUAL';
        self::$contra->entry_by = $request->entry_by;
        self::$contra->sconid = 1;
        self::$contra->pcomid = 1;
        self::$contra->save();
        Session::put('contra_narration', $request->narration);
    }
}

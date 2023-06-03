<?php

namespace App\Models\Accounts\Vouchers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class AccJournalMaster extends Model
{
    use HasFactory;

    protected $primaryKey = 'voucher_no';

    public static $voucherno;


    public static function initiateVoucher($request)
    {
        self::$voucherno = new AccJournalMaster();
        self::$voucherno->voucher_no = $request->voucher_no;
        self::$voucherno->voucher_date = $request->receipt_date;
        self::$voucherno->person = $request->person;
        self::$voucherno->cheque_no = $request->cheque_no;
        self::$voucherno->cheque_date = $request->cheque_date;
        self::$voucherno->maturity_date = $request->maturity_date;
        self::$voucherno->cheque_of_bank = $request->cheque_of_bank;
        self::$voucherno->cash_bank_ledger = $request->cash_bank_ledger;
        self::$voucherno->amount = $request->amount;
        self::$voucherno->journal_type = $request->journal_type;
        self::$voucherno->status = 'MANUAL';
        self::$voucherno->entry_by = $request->entry_by;
        self::$voucherno->entry_at = $request->entry_at;
        self::$voucherno->checked_by = 0;
        self::$voucherno->checked_at = date('Y-m-d H:i:s');
        self::$voucherno->approved_by = 0;
        self::$voucherno->approved_at = date('Y-m-d H:i:s');
        self::$voucherno->audited_by = 0;
        self::$voucherno->audited_at = date('Y-m-d H:i:s');
        self::$voucherno->deleted_resone = 0;
        self::$voucherno->deleted_by = 0;
        self::$voucherno->deleted_at = date('Y-m-d H:i:s');
        self::$voucherno->ip = 1;
        self::$voucherno->mac = 1;
        self::$voucherno->sconid = 1;
        self::$voucherno->pcomid = 1;
        self::$voucherno->save();
        Session::put('receipt_no', $request->voucher_no);
    }
}

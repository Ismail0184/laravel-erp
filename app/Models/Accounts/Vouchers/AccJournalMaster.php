<?php

namespace App\Models\Accounts\Vouchers;

use App\Models\Accounts\AccLedger;
use App\Models\User;
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
        self::$voucherno->voucher_date = $request->voucher_date;
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

    public static function updateVoucher($request, $id)
    {
        self::$voucherno = AccJournalMaster::find($id);
        self::$voucherno->voucher_no = $request->voucher_no;
        self::$voucherno->voucher_date = $request->voucher_date;
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
    }

    public static function ConfirmVoucher($request, $id)
    {
        self::$voucherno = AccJournalMaster::find($id);
        self::$voucherno->status = 'UNCHECKED';
        self::$voucherno->save();
    }

    public static function destroyVoucher($id)
    {
        self::$voucherno = AccJournalMaster::find($id);
        self::$voucherno->delete();
    }

    public function accledger()
    {
        return $this->belongsTo(AccLedger::class,'cash_bank_ledger','ledger_id');
    }

    public function entryBy()
    {
        return $this->belongsTo(User::class,'entry_by','id');
    }

    public static function deletedVoucher($id)
    {
        self::$voucherno = AccJournalMaster::find($id) ;
        self::$voucherno->status = 'deleted';
        self::$voucherno->save();
    }

    public static function receiptVoucherStatusUpdate($request, $id)
    {
        self::$voucherno = AccJournalMaster::find($id) ;
        self::$voucherno->status = $request->status;
        if($request->status=='CHECKED') {
            self::$voucherno->checked_by = $request->checked_by;
            self::$voucherno->checked_at = now();
        } elseif ($request->status=='APPROVED'){
            self::$voucherno->approved_by = $request->approved_by;
            self::$voucherno->approved_at = now();
        } elseif ($request->status=='AUDITED') {
            self::$voucherno->audited_by = $request->audited_by;
            self::$voucherno->audited_at = now();
        }
        self::$voucherno->save();
    }
}

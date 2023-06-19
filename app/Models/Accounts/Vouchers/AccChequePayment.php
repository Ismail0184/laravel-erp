<?php

namespace App\Models\Accounts\Vouchers;

use App\Models\Accounts\AccLedger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class AccChequePayment extends Model
{
    use HasFactory;

    public static $cpayment;

    public static function addCPaymentData($request)
    {
        self::$cpayment = new AccChequePayment();
        self::$cpayment->cpayment_no = $request->cpayment_no;
        self::$cpayment->cpayment_date = $request->cpayment_date;
        self::$cpayment->narration = $request->narration;
        self::$cpayment->ledger_id = $request->ledger_id;
        self::$cpayment->relevant_cash_head = $request->relevant_cash_head;
        self::$cpayment->dr_amt = $request->dr_amt;
        self::$cpayment->cr_amt = 0;
        self::$cpayment->cc_code = $request->cc_code;
        self::$cpayment->status = 'MANUAL';
        self::$cpayment->entry_by = $request->entry_by;
        self::$cpayment->sconid = 1;
        self::$cpayment->pcomid = 1;
        self::$cpayment->save();
        Session::put('cpayment_narration', $request->narration);
    }

    public static function addCPaymentDataCr($request)
    {
        self::$cpayment = new AccChequePayment();
        self::$cpayment->cpayment_no = $request->cpayment_no;
        self::$cpayment->cpayment_date = $request->cpayment_date;
        self::$cpayment->narration = $request->narration;
        self::$cpayment->ledger_id = $request->relevant_cash_head;
        self::$cpayment->relevant_cash_head = 0;
        self::$cpayment->dr_amt = 0;
        self::$cpayment->cr_amt = $request->amount;
        self::$cpayment->cc_code = 0;
        self::$cpayment->type = 'Credit';
        self::$cpayment->status = 'MANUAL';
        self::$cpayment->entry_by = $request->entry_by;
        self::$cpayment->sconid = 1;
        self::$cpayment->pcomid = 1;
        self::$cpayment->save();
    }

    public static function updateCPaymentData($request, $id)
    {
        self::$cpayment = AccChequePayment::find($id);
        self::$cpayment->cpayment_no = $request->cpayment_no;
        self::$cpayment->cpayment_date = $request->cpayment_date;
        self::$cpayment->narration = $request->narration;
        self::$cpayment->ledger_id = $request->relevant_cash_head;
        self::$cpayment->relevant_cash_head = 0;
        if (($request->dr_amt>0) && ($request->cr_amt==0) ) {
            self::$cpayment->dr_amt = $request->dr_amt;
            self::$cpayment->cr_amt = 0;
            self::$cpayment->type = 'Debit';
        } elseif (($request->cr_amt>0) && ($request->dr_amt==0)) {
            self::$cpayment->dr_amt = 0;
            self::$cpayment->cr_amt = $request->cr_amt;
            self::$cpayment->type = 'Credit';
        } elseif (($request->cr_amt>0) &&  ($request->dr_amt>0)) {
            self::$cpayment->dr_amt = 0;
            self::$cpayment->cr_amt = 0;
        }
        self::$cpayment->cc_code = 0;
        self::$cpayment->type = 'Credit';
        self::$cpayment->status = 'MANUAL';
        self::$cpayment->entry_by = $request->entry_by;
        self::$cpayment->sconid = 1;
        self::$cpayment->pcomid = 1;
        self::$cpayment->save();
    }

    public static function destroyCPaymentData($id)
    {
        self::$cpayment = AccChequePayment::find($id);
        self::$cpayment->delete();
    }

    public static function destroyCPaymentAllData($id)
    {
        self::$cpayment = AccChequePayment::where('cpayment_no', $id);
        self::$cpayment->delete();
    }

    public static function confirmCPaymentVoucher($request, $id)
    {
        AccChequePayment::where('cpayment_no',$id)->update(['status'=>'UNCHECKED']);
    }

    public function ledgerforvoucher()
    {
        return $this->belongsTo(AccLedger::class, 'ledger_id','ledger_id');
    }

    public function ledger()
    {
        return $this->belongsTo(AccLedger::class, 'ledger_id','ledger_id');
    }

    public static function deletedCPaymentVoucher($id)
    {
        AccChequePayment::where('cpayment_no',$id)->update(['status'=>'DELETED']);
    }

    public static function statusupdate($request, $id)
    {
        AccChequePayment::where('cpayment_no',$id)->update(['status'=>$request->status]);
    }
}

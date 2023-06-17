<?php

namespace App\Models\Accounts\Vouchers;

use App\Models\Accounts\AccLedger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Session;

class AccPayment extends Model
{
    use HasFactory;

    public static $payment;

    public static function addPaymentData($request)
    {
        self::$payment = new AccPayment();
        self::$payment->payment_no = $request->payment_no;
        self::$payment->payment_date = $request->payment_date;
        self::$payment->narration = $request->narration;
        self::$payment->ledger_id = $request->ledger_id;
        self::$payment->relevant_cash_head = $request->relevant_cash_head;

        if (($request->vouchertype=='multiple') && ($request->dr_amt>0) && ($request->cr_amt==0) ) {
            self::$payment->dr_amt = $request->dr_amt;
            self::$payment->cr_amt = 0;
            self::$payment->type = 'Debit';
        } elseif (($request->vouchertype=='multiple') && ($request->cr_amt>0) && ($request->dr_amt==0)) {
            self::$payment->dr_amt = 0;
            self::$payment->cr_amt = $request->cr_amt;
            self::$payment->type = 'Credit';
        } elseif (($request->vouchertype=='multiple') && ($request->cr_amt>0) &&  ($request->dr_amt>0)) {
            self::$payment->dr_amt = 0;
            self::$payment->cr_amt = 0;
        } elseif ($request->vouchertype!=='multiple') {
            self::$payment->dr_amt = $request->dr_amt;
            self::$payment->cr_amt = 0;
            self::$payment->type = 'Debit';
        } else {
            self::$payment->dr_amt = 0;
            self::$payment->cr_amt = 0;
        }
        self::$payment->cc_code = $request->cc_code;
        self::$payment->status = 'MANUAL';
        self::$payment->entry_by = $request->entry_by;
        self::$payment->sconid = 1;
        self::$payment->pcomid = 1;
        if (($request->vouchertype=='multiple') && ($request->cr_amt>0) &&  ($request->dr_amt>0)) {

        } elseif (($request->vouchertype=='multiple') && ($request->cr_amt==0) &&  ($request->dr_amt==0))
        { } else {
            self::$payment->save();
        }
        Session::put('payment_narration', $request->narration);
    }

    public static function addPaymentDataCr($request)
    {
        self::$payment = new AccPayment();
        self::$payment->payment_no = $request->payment_no;
        self::$payment->payment_date = $request->payment_date;
        self::$payment->narration = $request->narration;
        self::$payment->ledger_id = $request->relevant_cash_head;
        self::$payment->relevant_cash_head = 0;
        self::$payment->dr_amt = 0;
        self::$payment->cr_amt = $request->amount;
        self::$payment->cc_code = 0;
        self::$payment->type = 'Credit';
        self::$payment->status = 'MANUAL';
        self::$payment->entry_by = $request->entry_by;
        self::$payment->sconid = 1;
        self::$payment->pcomid = 1;
        self::$payment->save();
    }

    public static function updatePaymentData($request, $id)
    {
        self::$payment = AccPayment::find($id);
        self::$payment->payment_no = $request->payment_no;
        self::$payment->payment_date = $request->payment_date;
        self::$payment->narration = $request->narration;
        self::$payment->ledger_id = $request->ledger_id;
        self::$payment->relevant_cash_head = $request->relevant_cash_head;
        if (($request->vouchertype=='multiple') && ($request->dr_amt>0) && ($request->cr_amt==0) ) {
            self::$payment->dr_amt = $request->dr_amt;
            self::$payment->cr_amt = 0;
            self::$payment->type = 'Debit';
        } elseif (($request->vouchertype=='multiple') && ($request->cr_amt>0) && ($request->dr_amt==0)) {
            self::$payment->dr_amt = 0;
            self::$payment->cr_amt = $request->cr_amt;
            self::$payment->type = 'Credit';
        } elseif (($request->vouchertype=='multiple') && ($request->cr_amt>0) &&  ($request->dr_amt>0)) {
            self::$payment->dr_amt = 0;
            self::$payment->cr_amt = 0;
        } elseif ($request->vouchertype!=='multiple') {
            self::$payment->dr_amt = $request->dr_amt;
            self::$payment->cr_amt = 0;
            self::$payment->type = 'Debit';
        } else {
            self::$payment->dr_amt = 0;
            self::$payment->cr_amt = 0;
        }
        self::$payment->type = 'Debit';
        self::$payment->status = 'MANUAL';
        self::$payment->entry_by = $request->entry_by;
        self::$payment->sconid = 1;
        self::$payment->pcomid = 1;
        self::$payment->save();
    }

    public static function destroyPaymentData($id)
    {
        self::$payment = AccPayment::find($id);
        self::$payment->delete();
    }

    public static function destroyPaymentAllData($id)
    {
        self::$payment = AccPayment::where('payment_no', $id);
        self::$payment->delete();
    }

    public static function confirmPaymentVoucher($request, $id)
    {
        AccPayment::where('payment_no',$id)->update(['status'=>'UNCHECKED']);
    }

    public function ledgerforvoucher()
    {
        return $this->belongsTo(AccLedger::class, 'ledger_id','ledger_id');
    }

    public function ledger()
    {
        return $this->belongsTo(AccLedger::class, 'ledger_id','ledger_id');
    }

    public static function deletedPaymentVoucher($id)
    {
        AccPayment::where('payment_no',$id)->update(['status'=>'DELETED']);
    }

    public static function statusupdate($request, $id)
    {
        AccPayment::where('payment_no',$id)->update(['status'=>$request->status]);
    }
}

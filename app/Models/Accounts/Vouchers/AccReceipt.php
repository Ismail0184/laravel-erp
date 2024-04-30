<?php

namespace App\Models\Accounts\Vouchers;

use App\Models\Accounts\AccLedger;
use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class AccReceipt extends Model
{
    use HasFactory;

    public static $receipt;

    public static function addReceiptData($request)
    {
        self::$receipt = new AccReceipt();
        self::$receipt->receipt_no = $request->receipt_no;
        self::$receipt->receipt_date = $request->receipt_date;
        self::$receipt->narration = $request->narration;
        self::$receipt->ledger_id = $request->ledger_id;
        self::$receipt->relevant_cash_head = $request->relevant_cash_head;

        if (($request->voucher_type=='multiple') && ($request->dr_amt>0) && ($request->cr_amt==0) ) {
            self::$receipt->dr_amt = $request->dr_amt;
            self::$receipt->cr_amt = 0;
            self::$receipt->type = 'Debit';
        } elseif (($request->voucher_type=='multiple') && ($request->cr_amt>0) && ($request->dr_amt==0)) {
            self::$receipt->dr_amt = 0;
            self::$receipt->cr_amt = $request->cr_amt;
            self::$receipt->type = 'Credit';
        } elseif (($request->voucher_type=='multiple') && ($request->cr_amt>0) &&  ($request->dr_amt>0)) {
            self::$receipt->dr_amt = 0;
            self::$receipt->cr_amt = 0;
        } elseif ($request->voucher_type!=='multiple') {
            self::$receipt->dr_amt = $request->dr_amt;
            self::$receipt->cr_amt = 0;
            self::$receipt->type = 'Debit';
        } else {
            self::$receipt->dr_amt = 0;
            self::$receipt->cr_amt = 0;
        }
        self::$receipt->status = 'MANUAL';
        self::$receipt->entry_by = $request->entry_by;
        self::$receipt->company_id = 1;
        self::$receipt->group_id = 1;
        if (($request->voucher_type=='multiple') && ($request->cr_amt>0) &&  ($request->dr_amt>0)) {

        } elseif (($request->voucher_type=='multiple') && ($request->cr_amt==0) &&  ($request->dr_amt==0))
        { } else {
            self::$receipt->save();
        }
        Session::put('receipt_narration', $request->narration);
    }

    public static function updateReceiptData($request, $id)
    {
        self::$receipt = AccReceipt::find($id);
        self::$receipt->receipt_no = $request->receipt_no;
        self::$receipt->receipt_date = $request->receipt_date;
        self::$receipt->narration = $request->narration;
        self::$receipt->ledger_id = $request->ledger_id;
        self::$receipt->relevant_cash_head = $request->relevant_cash_head;
        if (($request->voucher_type=='multiple') && ($request->dr_amt>0) && ($request->cr_amt==0) ) {
            self::$receipt->dr_amt = $request->dr_amt;
            self::$receipt->cr_amt = 0;
            self::$receipt->type = 'Debit';
        } elseif (($request->voucher_type=='multiple') && ($request->cr_amt>0) && ($request->dr_amt==0)) {
            self::$receipt->dr_amt = 0;
            self::$receipt->cr_amt = $request->cr_amt;
            self::$receipt->type = 'Credit';
        } elseif (($request->voucher_type=='multiple') && ($request->cr_amt>0) &&  ($request->dr_amt>0)) {
            self::$receipt->dr_amt = 0;
            self::$receipt->cr_amt = 0;
        } elseif ($request->voucher_type!=='multiple') {
            self::$receipt->dr_amt = $request->dr_amt;
            self::$receipt->cr_amt = 0;
            self::$receipt->type = 'Debit';
        } else {
            self::$receipt->dr_amt = 0;
            self::$receipt->cr_amt = 0;
        }
        self::$receipt->type = 'Debit';
        self::$receipt->status = 'MANUAL';
        self::$receipt->entry_by = $request->entry_by;
        self::$receipt->company_id = 1;
        self::$receipt->group_id = 1;
        self::$receipt->save();
    }



    public static function addReceiptDataCr($request)
    {
        self::$receipt = new AccReceipt();
        self::$receipt->receipt_no = $request->receipt_no;
        self::$receipt->receipt_date = $request->receipt_date;
        self::$receipt->narration = $request->narration;
        self::$receipt->ledger_id = $request->relevant_cash_head;
        self::$receipt->relevant_cash_head = 0;
        self::$receipt->dr_amt = 0;
        self::$receipt->cr_amt = $request->amount;
        self::$receipt->type = 'Credit';
        self::$receipt->status = 'MANUAL';
        self::$receipt->entry_by = $request->entry_by;
        self::$receipt->company_id = 1;
        self::$receipt->group_id = 1;
        self::$receipt->save();
    }

    public static function destroyRceiptData($id)
    {
        self::$receipt = AccReceipt::find($id);
        self::$receipt->delete();
    }

    public static function destroyReceiptAllData($id)
    {
        self::$receipt = AccReceipt::where('receipt_no', $id);
        self::$receipt->delete();
    }

    public function ledger()
    {
        return $this->belongsTo(AccLedger::class, 'ledger_id','ledger_id');
    }

    public function ledgerforvoucher()
    {
        return $this->belongsTo(AccLedger::class, 'ledger_id','ledger_id');
    }

    public static function confirmReceiptVoucher($request, $id)
    {
        AccReceipt::where('receipt_no',$id)->update(['status'=>'UNCHECKED']);
    }

    public static function deletedReceiptVoucher($id)
    {
        AccReceipt::where('receipt_no',$id)->update(['status'=>'DELETED']);
    }

    public static function statusupdate($request, $id)
    {
        AccReceipt::where('receipt_no',$id)->update(['status'=>$request->status]);
    }
}

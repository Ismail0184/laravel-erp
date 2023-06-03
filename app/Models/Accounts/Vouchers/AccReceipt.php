<?php

namespace App\Models\Accounts\Vouchers;

use App\Models\Accounts\AccLedger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        self::$receipt->dr_amt = $request->dr_amt;
        self::$receipt->cr_amt = 0;
        self::$receipt->type = 'Debit';
        self::$receipt->status = 'MANUAL';
        self::$receipt->entry_by = $request->entry_by;
        self::$receipt->sconid = 1;
        self::$receipt->pcomid = 1;
        self::$receipt->save();
    }

    public static function updateReceiptData($request, $id)
    {
        self::$receipt = AccReceipt::find($id);
        self::$receipt->receipt_no = $request->receipt_no;
        self::$receipt->receipt_date = $request->receipt_date;
        self::$receipt->narration = $request->narration;
        self::$receipt->ledger_id = $request->ledger_id;
        self::$receipt->relevant_cash_head = $request->relevant_cash_head;
        self::$receipt->dr_amt = $request->dr_amt;
        self::$receipt->cr_amt = 0;
        self::$receipt->type = 'Debit';
        self::$receipt->status = 'MANUAL';
        self::$receipt->entry_by = $request->entry_by;
        self::$receipt->sconid = 1;
        self::$receipt->pcomid = 1;
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
}

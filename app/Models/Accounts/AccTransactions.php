<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class AccTransactions extends Model
{
    use HasFactory;

    public static $transaction;

    public static function addReceiptVoucher($request, $transaction_id)
    {
        self::$transaction                      = new AccTransactions();
        self::$transaction->transaction_no      = $transaction_id;
        self::$transaction->transaction_date    = $request->receipt_date;
        self::$transaction->ledger_id           = $request->ledger_id;
        self::$transaction->relevant_cash_head  = $request->relevant_cash_head;
        self::$transaction->narration           = $request->narration;
        self::$transaction->dr_amt              = $request->dr_amt;
        self::$transaction->cr_amt              = $request->cr_amt;
        self::$transaction->cc_code             = 0;
        self::$transaction->type                = $request->type;
        self::$transaction->vr_from             = 'receipt';
        self::$transaction->vr_no               = $request->receipt_no;
        self::$transaction->vr_id               = $request->id;
        self::$transaction->status              = 'UNCHECKED';
        self::$transaction->entry_by            = $request->entry_by;
        self::$transaction->company_id          = Auth::user()->company_id ?? 0;
        self::$transaction->group_id            = Auth::user()->group_id ?? 0;
        self::$transaction->save();
    }

    public static function addPaymentVoucher($request, $transaction_id)
    {
        self::$transaction                      = new AccTransactions();
        self::$transaction->transaction_no      = $transaction_id;
        self::$transaction->transaction_date    = $request->payment_date;
        self::$transaction->ledger_id           = $request->ledger_id;
        self::$transaction->relevant_cash_head  = $request->relevant_cash_head;
        self::$transaction->narration           = $request->narration;
        self::$transaction->dr_amt              = $request->dr_amt;
        self::$transaction->cr_amt              = $request->cr_amt;
        self::$transaction->cc_code             = $request->cc_code;
        self::$transaction->type                = $request->type;
        self::$transaction->vr_from             = 'payment';
        self::$transaction->vr_no               = $request->payment_no;
        self::$transaction->vr_id               = $request->id;
        self::$transaction->status              = 'UNCHECKED';
        self::$transaction->entry_by            = $request->entry_by;
        self::$transaction->company_id          = Auth::user()->company_id ?? 0;
        self::$transaction->group_id            = Auth::user()->group_id ?? 0;
        self::$transaction->save();
    }

    public static function addJournalVoucher($request, $transaction_id)
    {
        self::$transaction                      = new AccTransactions();
        self::$transaction->transaction_no      = $transaction_id;
        self::$transaction->transaction_date    = $request->journal_date;
        self::$transaction->ledger_id           = $request->ledger_id;
        self::$transaction->relevant_cash_head  = $request->relevant_cash_head;
        self::$transaction->narration           = $request->narration;
        self::$transaction->dr_amt              = $request->dr_amt;
        self::$transaction->cr_amt              = $request->cr_amt;
        self::$transaction->cc_code             = $request->cc_code;
        self::$transaction->type                = $request->type;
        self::$transaction->vr_from             = 'journal';
        self::$transaction->vr_no               = $request->journal_no;
        self::$transaction->vr_id               = $request->id;
        self::$transaction->status              = 'UNCHECKED';
        self::$transaction->entry_by            = $request->entry_by;
        self::$transaction->company_id          = Auth::user()->company_id ?? 0;
        self::$transaction->group_id            = Auth::user()->group_id ?? 0;
        self::$transaction->save();
    }

    public static function addContraVoucher($request, $transaction_id)
    {
        self::$transaction                      = new AccTransactions();
        self::$transaction->transaction_no      = $transaction_id;
        self::$transaction->transaction_date    = $request->contra_date;
        self::$transaction->ledger_id           = $request->ledger_id;
        self::$transaction->relevant_cash_head  = $request->relevant_cash_head;
        self::$transaction->narration           = $request->narration;
        self::$transaction->dr_amt              = $request->dr_amt;
        self::$transaction->cr_amt              = $request->cr_amt;
        self::$transaction->cc_code             = 0;
        self::$transaction->type                = $request->type;
        self::$transaction->vr_from             = 'contra';
        self::$transaction->vr_no               = $request->contra_no;
        self::$transaction->vr_id               = $request->id;
        self::$transaction->status              = 'UNCHECKED';
        self::$transaction->entry_by            = $request->entry_by;
        self::$transaction->company_id          = Auth::user()->company_id ?? 0;
        self::$transaction->group_id            = Auth::user()->group_id ?? 0;
        self::$transaction->save();
    }

    public static function deletedTransaction($id)
    {
        AccTransactions::where('vr_no',$id)->update(['status'=>'DELETED']);
    }
    public static function recoveryDeletedTransaction($id)
    {
        AccTransactions::where('vr_no',$id)->update(['status'=>'UNCHECKED']);
    }

    public static function previousTransactionDeleteWhileEdit($id)
    {
        self::$transaction = AccTransactions::where('vr_no',$id);
        self::$transaction->delete();
    }

    public function ledgerName()
    {
        return $this->belongsTo(AccLedger::class,'ledger_id','ledger_id');
    }
}

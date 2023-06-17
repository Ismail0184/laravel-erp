<?php

namespace App\Models\Accounts\Vouchers;

use App\Models\Accounts\AccLedger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class AccJournal extends Model
{
    use HasFactory;

    public static $journal;


    public static function addJournalData($request)
    {
        self::$journal = new AccJournal();
        self::$journal->journal_no = $request->journal_no;
        self::$journal->journal_date = $request->journal_date;
        self::$journal->narration = $request->narration;
        self::$journal->ledger_id = $request->ledger_id;
        self::$journal->relevant_cash_head = $request->relevant_cash_head;
        if($request->dr_amt>0 && $request->cr_amt=='') {
            self::$journal->dr_amt = $request->dr_amt;
            self::$journal->cr_amt = 0;
        } elseif ($request->cr_amt>0 && $request->dr_amt==''){
            self::$journal->dr_amt = 0;
            self::$journal->cr_amt = $request->cr_amt;
        }
        self::$journal->cc_code = $request->cc_code;
        self::$journal->status = 'MANUAL';
        self::$journal->entry_by = $request->entry_by;
        self::$journal->sconid = 1;
        self::$journal->pcomid = 1;
        self::$journal->save();
        Session::put('journal_narration', $request->narration);
    }

    public static function updateJournalData($request, $id)
    {
        self::$journal = AccJournal::find($id);
        self::$journal->journal_no = $request->journal_no;
        self::$journal->journal_date = $request->journal_date;
        self::$journal->narration = $request->narration;
        self::$journal->ledger_id = $request->ledger_id;
        self::$journal->relevant_cash_head = $request->relevant_cash_head;
        if($request->dr_amt>0 && $request->cr_amt==0) {
            self::$journal->dr_amt = $request->dr_amt;
            self::$journal->cr_amt = 0;
        } elseif ($request->cr_amt>0 && $request->dr_amt==0){
            self::$journal->dr_amt = 0;
            self::$journal->cr_amt = $request->cr_amt;
        }
        self::$journal->cc_code = $request->cc_code;
        self::$journal->status = 'MANUAL';
        self::$journal->entry_by = $request->entry_by;
        self::$journal->sconid = 1;
        self::$journal->pcomid = 1;
        self::$journal->save();
    }

    public static function destroyJournalData($id)
    {
        self::$journal = AccJournal::find($id);
        self::$journal->delete();
    }

    public static function destroyJournalAllData($id)
    {
        self::$journal = AccJournal::where('journal_no', $id);
        self::$journal->delete();
    }

    public static function confirmJournalVoucher($request, $id)
    {
        AccJournal::where('journal_no',$id)->update(['status'=>'UNCHECKED']);
    }

    public function ledgerforvoucher()
    {
        return $this->belongsTo(AccLedger::class, 'ledger_id','ledger_id');
    }

    public function ledger()
    {
        return $this->belongsTo(AccLedger::class, 'ledger_id','ledger_id');
    }
    public static function statusupdate($request, $id)
    {
        AccJournal::where('journal_no',$id)->update(['status'=>$request->status]);
    }
}

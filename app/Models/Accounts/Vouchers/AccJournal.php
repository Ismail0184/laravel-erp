<?php

namespace App\Models\Accounts\Vouchers;

use App\Models\Accounts\AccCostCenter;
use App\Models\Accounts\AccLedger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
use Auth;

class AccJournal extends Model
{
    use HasFactory;

    public static $journal,$image, $imageName, $directory, $imageUrl;

    public static function getImageUrl($request)
    {
        if (!empty($request->image)) {
            self::$image = $request->file('image');
            self::$imageName = self::$image->getClientOriginalName();
            self::$directory = 'assets/images/vouchers/journal/'.$request->journal_no.'/';
            self::$image->move(self::$directory, self::$imageName);
            return self::$directory . self::$imageName;
        }
    }


    public static function addJournalData($request)
    {
        self::$journal = new AccJournal();
        self::$journal->balance = $request->balance;
        self::$journal->journal_no = $request->journal_no;
        self::$journal->journal_date = $request->journal_date;
        self::$journal->narration = $request->narration;
        self::$journal->ledger_id = $request->ledger_id;
        self::$journal->relevant_cash_head = $request->relevant_cash_head;
        self::$journal->journal_attachment = self::getImageUrl($request);
        if($request->dr_amt>0) {
            self::$journal->dr_amt = $request->dr_amt;
            self::$journal->cr_amt = 0;
            self::$journal->type = 'Debit';
        } elseif ($request->cr_amt>0){
            self::$journal->dr_amt = 0;
            self::$journal->cr_amt = $request->cr_amt;
            self::$journal->type = 'Credit';
        }
        self::$journal->cc_code = $request->cc_code;
        self::$journal->status = 'MANUAL';
        self::$journal->entry_by = $request->entry_by;
        self::$journal->company_id = Auth::user()->company_id ?? 0;
        self::$journal->group_id = Auth::user()->group_id ?? 0;
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
        self::$journal->company_id = Auth::user()->company_id ?? 0;
        self::$journal->group_id = Auth::user()->group_id ?? 0;
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

    public static function recoveryDeletedJournalVoucher($id)
    {
        AccJournal::where('journal_no',$id)->update(['status'=>'UNCHECKED']);
    }

    public static function statusupdate($request, $id)
    {
        AccJournal::where('journal_no',$id)->update(['status'=>$request->status]);
    }

    public static function deletedJournalVoucher($id)
    {
        AccJournal::where('journal_no',$id)->update(['status'=>'DELETED']);
    }

    public function getCostCenterData()
    {
        return $this->belongsTo(AccCostCenter::class,'cc_code','cc_code');
    }
}

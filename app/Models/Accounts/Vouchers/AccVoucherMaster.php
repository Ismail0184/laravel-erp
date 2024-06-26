<?php

namespace App\Models\Accounts\Vouchers;

use App\Models\Accounts\AccLedger;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
use Auth;

class AccVoucherMaster extends Model
{
    use HasFactory;

    protected $primaryKey = 'voucher_no';
    public static $voucherno;
    public static function initiateVoucher($request)
    {
        self::$voucherno                    = new AccVoucherMaster();
        self::$voucherno->voucher_no        = $request->voucher_no;
        self::$voucherno->voucher_date      = $request->voucher_date;
        self::$voucherno->person            = $request->person;
        self::$voucherno->cheque_no         = $request->cheque_no;
        self::$voucherno->cheque_date       = $request->cheque_date;
        self::$voucherno->maturity_date     = $request->maturity_date;
        self::$voucherno->cheque_of_bank    = $request->cheque_of_bank;
        self::$voucherno->cash_bank_ledger  = $request->cash_bank_ledger;
        self::$voucherno->ledger_balance    = $request->ledger_balance;
        self::$voucherno->amount            = $request->amount;
        self::$voucherno->journal_type      = $request->journal_type;
        self::$voucherno->voucher_type      = $request->voucher_type;
        self::$voucherno->status            = 'MANUAL';
        self::$voucherno->entry_by          = $request->entry_by;
        self::$voucherno->entry_at          = $request->entry_at;
        self::$voucherno->company_id        = Auth::user()->company_id ?? 0;
        self::$voucherno->group_id          = Auth::user()->group_id ?? 0;
        self::$voucherno->save();

        if ($request->journal_type=='receipt') {
            Session::put('receipt_no', $request->voucher_no);
        } elseif ($request->journal_type=='payment'){
            Session::put('payment_no', $request->voucher_no);
        } elseif ($request->journal_type=='journal'){
            Session::put('journal_no', $request->voucher_no);
        } elseif ($request->journal_type=='contra'){
            Session::put('contra_no', $request->voucher_no);
        } elseif ($request->journal_type=='cheque'){
            Session::put('cpayment_no', $request->voucher_no);
        }
    }

    public static function updateVoucher($request, $id)
    {
        self::$voucherno = AccVoucherMaster::find($id);
        self::$voucherno->voucher_no        = $request->voucher_no;
        self::$voucherno->voucher_date      = $request->voucher_date;
        self::$voucherno->person            = $request->person;
        self::$voucherno->cheque_no         = $request->cheque_no;
        self::$voucherno->cheque_date       = $request->cheque_date;
        self::$voucherno->maturity_date     = $request->maturity_date;
        self::$voucherno->cheque_of_bank    = $request->cheque_of_bank;
        self::$voucherno->cash_bank_ledger  = $request->cash_bank_ledger;
        self::$voucherno->ledger_balance    = $request->ledger_balance;
        self::$voucherno->amount            = $request->amount;
        self::$voucherno->journal_type      = $request->journal_type;
        self::$voucherno->status            = 'MANUAL';
        self::$voucherno->entry_by          = $request->entry_by;
        self::$voucherno->entry_at          = $request->entry_at;
        self::$voucherno->save();
    }

    public static function ConfirmVoucher($request, $id)
    {
        self::$voucherno = AccVoucherMaster::find($id);
        self::$voucherno->status = 'UNCHECKED';
        self::$voucherno->save();
    }

    public static function destroyVoucher($id)
    {
        self::$voucherno = AccVoucherMaster::find($id);
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

    public function checkedBy()
    {
        return $this->belongsTo(User::class,'checked_by','id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class,'approved_by','id');
    }

    public function auditedBy()
    {
        return $this->belongsTo(User::class,'audited_by','id');
    }

    public static function deletedVoucher($id)
    {
        self::$voucherno = AccVoucherMaster::find($id) ;
        self::$voucherno->status = 'DELETED';
        self::$voucherno->entry_status = 'DELETED';
        self::$voucherno->deleted_by = Auth::user()->id;
        self::$voucherno->deleted_at = now();
        self::$voucherno->save();
    }

    public static function recoveryDeletedVoucher($id)
    {
        self::$voucherno = AccVoucherMaster::find($id) ;
        self::$voucherno->status = 'UNCHECKED';
        self::$voucherno->entry_status = 'RECOVERED';
        self::$voucherno->recovered_by = Auth::user()->id;
        self::$voucherno->recovered_at = now();
        self::$voucherno->save();
    }

    public static function VoucherStatusUpdate($request, $id)
    {
        self::$voucherno = AccVoucherMaster::find($id);

        if ($request->has('reject_while_checked'))
        {
            self::$voucherno->status = 'REJECTED';
            self::$voucherno->checked_status = 'REJECTED';
            self::$voucherno->remarks_while_checked = $request->remarks_while_checked;
            self::$voucherno->checked_by = $request->checked_by;
            self::$voucherno->checked_at = now();

        } elseif ($request->has('reject_while_approved')) {

            self::$voucherno->status = 'REJECTED';
            self::$voucherno->approved_status = 'REJECTED';
            self::$voucherno->remarks_while_approved = $request->remarks_while_approved;
            self::$voucherno->approved_by = $request->approved_by;
            self::$voucherno->approved_at = now();

        } elseif ($request->has('reject_while_audited')) {

            self::$voucherno->status = 'REJECTED';
            self::$voucherno->audited_status = 'REJECTED';
            self::$voucherno->remarks_while_audited = $request->remarks_while_audited;
            self::$voucherno->audited_by = $request->audited_by;
            self::$voucherno->audited_at = now();

        } elseif($request->status=='CHECKED') {

            self::$voucherno->status = 'CHECKED';
            self::$voucherno->checked_status = 'CHECKED';
            self::$voucherno->remarks_while_checked = $request->remarks_while_checked;
            self::$voucherno->checked_by = $request->checked_by;
            self::$voucherno->checked_at = now();

        } elseif ($request->status=='APPROVED'){
            self::$voucherno->status = 'APPROVED';
            self::$voucherno->approved_status = 'APPROVED';
            self::$voucherno->remarks_while_approved = $request->remarks_while_approved;
            self::$voucherno->approved_by = $request->approved_by;
            self::$voucherno->approved_at = now();
        } elseif ($request->status=='AUDITED') {
            self::$voucherno->status = 'AUDITED';
            self::$voucherno->audited_status = 'AUDITED';
            self::$voucherno->remarks_while_audited = $request->remarks_while_audited;
            self::$voucherno->audited_by = $request->audited_by;
            self::$voucherno->audited_at = now();
        }
        self::$voucherno->save();
    }

    public static function amountEquality($request)
    {
        AccVoucherMaster::where('voucher_no',$request->voucher_no)->update(['amount_equality'=>$request->amount_equality]);
    }

    public static function checkPersonView($id)
    {
        AccVoucherMaster::where('voucher_no',$id)->update(
            [
                'checker_person_viewed_at'=>now()
            ]
        );
    }

    public static function approvePersonView($id)
    {
        AccVoucherMaster::where('voucher_no',$id)->update(
            [
                'approving_person_viewed_at'=>now()
            ]
        );
    }

    public static function auditorPersonView($id)
    {
        AccVoucherMaster::where('voucher_no',$id)->update(
            [
                'auditing_person_viewed_at'=>now()
            ]
        );
    }

    public static function voucherEdit($id)
    {
        AccVoucherMaster::where('voucher_no',$id)->update(
            [
                'status'=>'MANUAL',
                'entry_status'=>'EDITED',
                'edited_by'=>Auth::user()->id,
                'edited_at'=>now()
            ]
        );
    }
}

<?php

namespace App\Models\Accounts\Vouchers;

use App\Models\Accounts\AccLedger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class AccContra extends Model
{
    use HasFactory;

    private static $contra;

    public static function addContraData($request)
    {
        self::$contra = new AccContra();
        self::$contra->contra_no = $request->contra_no;
        self::$contra->contra_date = $request->contra_date;
        self::$contra->narration = $request->narration;
        self::$contra->ledger_id = $request->ledger_id;
        self::$contra->relevant_cash_head = $request->relevant_cash_head;
        if($request->dr_amt>0 && $request->cr_amt=='') {
            self::$contra->dr_amt = $request->dr_amt;
            self::$contra->cr_amt = 0;
        } elseif ($request->cr_amt>0 && $request->dr_amt==''){
            self::$contra->dr_amt = 0;
            self::$contra->cr_amt = $request->cr_amt;
        }
        self::$contra->status = 'MANUAL';
        self::$contra->entry_by = $request->entry_by;
        self::$contra->sconid = 1;
        self::$contra->pcomid = 1;
        self::$contra->save();
        Session::put('contra_narration', $request->narration);
    }

    public static function updateContraData($request, $id)
    {
        self::$contra = AccContra::find($id);
        self::$contra->contra_no = $request->contra_no;
        self::$contra->contra_date = $request->contra_date;
        self::$contra->narration = $request->narration;
        self::$contra->ledger_id = $request->ledger_id;
        self::$contra->relevant_cash_head = $request->relevant_cash_head;
        if($request->dr_amt>0 && $request->cr_amt==0) {
            self::$contra->dr_amt = $request->dr_amt;
            self::$contra->cr_amt = 0;
        } elseif ($request->cr_amt>0 && $request->dr_amt==0){
            self::$contra->dr_amt = 0;
            self::$contra->cr_amt = $request->cr_amt;
        }
        self::$contra->status = 'MANUAL';
        self::$contra->entry_by = $request->entry_by;
        self::$contra->sconid = 1;
        self::$contra->pcomid = 1;
        self::$contra->save();
    }

    public static function destroyContraData($id)
    {
        self::$contra = AccContra::find($id);
        self::$contra->delete();
    }

    public static function destroyContraAllData($id)
    {
        self::$contra = AccContra::where('contra_no', $id);
        self::$contra->delete();
    }

    public function ledger()
    {
        return $this->belongsTo(AccLedger::class, 'ledger_id','ledger_id');
    }

    public static function confirmContraVoucher($request, $id)
    {
        AccContra::where('contra_no',$id)->update(['status'=>'UNCHECKED']);
    }

    public static function deletedContraVoucher($id)
    {
        AccContra::where('contra_no',$id)->update(['status'=>'DELETED']);
    }

    public static function statusupdate($request, $id)
    {
        AccContra::where('contra_no',$id)->update(['status'=>$request->status]);
    }

    public function ledgerforvoucher()
    {
        return $this->belongsTo(AccLedger::class, 'ledger_id','ledger_id');
    }
}

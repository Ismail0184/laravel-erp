<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccLedger extends Model
{
    use HasFactory;

    protected $primaryKey = 'ledger_id';

    public static $ledgers;

    public static function next_ledger_id($group_id)
    {
        $max=($group_id*1000000000000)+1000000000000;
        $min=($group_id*1000000000000);
        $maxIdInDatabase = AccLedger::where('ledger_id','>',$min)->where('ledger_id','<',$max)->where('group_id','=',$group_id)->where('ledger_id','like','%00000000')->max('ledger_id');
        if(!isset($acc_no)&&(is_null($maxIdInDatabase)))
            $acc_no=$min+100000000;
        else
            $acc_no=$maxIdInDatabase+100000000;
        return $acc_no;
    }

    public static function storeLedger($request)
    {
        self::$ledgers = new AccLedger();
        self::$ledgers->ledger_id = self::next_ledger_id($request->group_id);
        self::$ledgers->ledger_name = $request->ledger_name;
        self::$ledgers->group_id = $request->group_id;
        self::$ledgers->status = 'active';
        self::$ledgers->show_in_transaction = 1;
        self::$ledgers->type	 = 'ledger';
        self::$ledgers->sconid = '1';
        self::$ledgers->pcomid = '1';
        self::$ledgers->entry_by = $request->entry_by;
        self::$ledgers->update_by = 0;
        self::$ledgers->save();
    }

    public static function getLegerGroup($ledger_id)
    {
        $group_id = AccLedger::where('ledger_id','=',$ledger_id)->value('group_id');
        return $group_id;
    }
    public static function storeSubLedgerAsLedger($request)
    {
        self::$ledgers = new AccLedger();
        self::$ledgers->ledger_id = AccSubLedger::next_sub_ledger_id($request->ledger_id);
        self::$ledgers->ledger_name = $request->sub_ledger_name;
        self::$ledgers->group_id = self::getLegerGroup($request->ledger_id);
        self::$ledgers->status = 'active';
        self::$ledgers->show_in_transaction = 1;
        self::$ledgers->type	 = 'sub';
        self::$ledgers->sconid = '1';
        self::$ledgers->pcomid = '1';
        self::$ledgers->entry_by = $request->entry_by;
        self::$ledgers->update_by = 0;
        self::$ledgers->save();
    }

    public static function storeSubSubLedgerAsLedger($request)
    {
        self::$ledgers = new AccLedger();
        self::$ledgers->ledger_id           = AccSubSubLedger::next_sub_sub_ledger_id($request->sub_ledger_id);
        self::$ledgers->ledger_name         = $request->sub_sub_ledger_name;
        self::$ledgers->group_id            = self::getLegerGroup($request->sub_ledger_id);
        self::$ledgers->status              = 'active';
        self::$ledgers->show_in_transaction = 1;
        self::$ledgers->type	            = 'sub-sub';
        self::$ledgers->sconid              = '1';
        self::$ledgers->pcomid              = '1';
        self::$ledgers->entry_by            = $request->entry_by;
        self::$ledgers->update_by           = 0;
        self::$ledgers->save();
    }

    public static function updateLedger($request, $id)
    {
        self::$ledgers = AccLedger::find($id);
        self::$ledgers->ledger_name = $request->ledger_name;
        self::$ledgers->status = $request->status;
        self::$ledgers->show_in_transaction = $request->show_in_transaction;
        self::$ledgers->update_by = $request->entry_by;
        self::$ledgers->save();
    }

    public static function updateSubLedgerAsLedger($request, $id)
    {
        self::$ledgers = AccLedger::find($id);
        self::$ledgers->ledger_name = $request->sub_ledger_name;
        self::$ledgers->status = $request->status;
        self::$ledgers->show_in_transaction = $request->show_in_transaction;
        self::$ledgers->entry_by = $request->entry_by;
        self::$ledgers->save();
    }

    public static function updateSubSubLedgerAsLedger($request, $id)
    {
        self::$ledgers = AccLedger::find($id);
        self::$ledgers->ledger_name         = $request->sub_sub_ledger_name;
        self::$ledgers->status              = $request->status;
        self::$ledgers->show_in_transaction = $request->show_in_transaction;
        self::$ledgers->update_by           = $request->entry_by;
        self::$ledgers->save();
    }

    public static function destroyLedger($id)
    {
        self::$ledgers = AccLedger::find($id) ;
        self::$ledgers->status = 'deleted';
        self::$ledgers->save();
    }

    public function accLedgerGroup()
    {
        return $this->belongsTo(AccLedgerGroup::class , 'group_id', 'group_id');
    }

    public function subLedgers()
    {
        return $this->hasMany(AccSubLedger::class,'ledger_id','ledger_id')->where('status','=','active');
    }

}

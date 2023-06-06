<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccSubLedger extends Model
{
    use HasFactory;

    protected $primaryKey = 'sub_ledger_id';
    public static $subLedger;

    public static function next_sub_ledger_id($ledger_id)
    {
        $max=$ledger_id+100000000;
        $min=$ledger_id;
        $maxIdInDatabase = AccLedger::where('ledger_id','>',$min)->where('ledger_id','<',$max)->where('ledger_id','like','%0000')->max('ledger_id');
        if(!isset($acc_no)&&(is_null($maxIdInDatabase)))
            $acc_no=$min+10000;
        else
            $acc_no=$maxIdInDatabase+10000;
        return $acc_no;
    }

    public static function storeSubLedger($request)
    {
        self::$subLedger = new AccSubLedger();
        self::$subLedger->ledger_id = $request->ledger_id;
        self::$subLedger->sub_ledger_id = self::next_sub_ledger_id($request->ledger_id);
        self::$subLedger->sub_ledger_name = $request->sub_ledger_name;
        self::$subLedger->status = 'active';
        self::$subLedger->sconid = 1;
        self::$subLedger->pcomid = 1;
        self::$subLedger->entry_by = $request->entry_by;
        self::$subLedger->update_by = 0;
        self::$subLedger->save();
    }

    public static function updateSubLedger($request, $id)
    {
        self::$subLedger = AccSubLedger::find($id);
        self::$subLedger->sub_ledger_name = $request->sub_ledger_name;
        self::$subLedger->status = $request->status;
        self::$subLedger->sconid = 1;
        self::$subLedger->pcomid = 1;
        self::$subLedger->update_by = $request->entry_by;
        self::$subLedger->save();
    }

    public static function destroySubLedger($id)
    {
        self::$subLedger = AccSubLedger::find($id);
        self::$subLedger->status = 'deleted';
        self::$subLedger->save();

        self::$subLedger = AccLedger::find($id) ;
        self::$subLedger->status = 'deleted';
        self::$subLedger->save();
    }

    public function getLedgerforSubledger()
    {
        return $this->belongsTo(AccLedger::class,'ledger_id');
    }
}

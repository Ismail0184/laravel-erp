<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccSubSubLedger extends Model
{
    use HasFactory;

    protected $primaryKey = 'sub_sub_ledger_id';
    public static $subsubLedger;

    public static function next_sub_sub_ledger_id($ledger_id)
    {
        $max=number_format(($ledger_id+10000),0,'','');
        $min=number_format($ledger_id,0,'','');
        $maxIdInDatabase = AccLedger::where('ledger_id','>',$min)->where('ledger_id','<',$max)->max('ledger_id');
        if((is_null($maxIdInDatabase)))
            $acc_no=number_format(($min+1),0,'','');
        else
            $acc_no=number_format(($maxIdInDatabase+1),0,'','');
        return $acc_no;
    }

    public static function storeSubSubLedger($request)
    {
        self::$subsubLedger = new AccSubSubLedger();
        self::$subsubLedger->sub_sub_ledger_id      = self::next_sub_sub_ledger_id($request->sub_ledger_id);
        self::$subsubLedger->sub_sub_ledger_name    = $request->sub_sub_ledger_name;
        self::$subsubLedger->sub_ledger_id          = $request->sub_ledger_id;
        self::$subsubLedger->status                 = 'active';
        self::$subsubLedger->sconid                 = 1;
        self::$subsubLedger->pcomid                 = 1;
        self::$subsubLedger->entry_by               = $request->entry_by;
        self::$subsubLedger->update_by              = 0;
        self::$subsubLedger->save();
    }

    public static function updateSubSubLedger($request, $id)
    {
        self::$subsubLedger = AccSubSubLedger::find($id);
        self::$subsubLedger->sub_sub_ledger_name    = $request->sub_sub_ledger_name;
        self::$subsubLedger->status                 = $request->status;
        self::$subsubLedger->update_by              = $request->entry_by;
        self::$subsubLedger->save();
    }

    public static function destroySubSubLedger($id)
    {
        self::$subsubLedger = AccSubSubLedger::find($id);
        self::$subsubLedger->status = 'deleted';
        self::$subsubLedger->save();

        self::$subsubLedger = AccLedger::find($id) ;
        self::$subsubLedger->status = 'deleted';
        self::$subsubLedger->save();
    }

    public function accSubLedgerGetforSubSubLedger()
    {
        return $this->belongsTo(AccSubLedger::class,'sub_ledger_id','sub_ledger_id');
    }
}

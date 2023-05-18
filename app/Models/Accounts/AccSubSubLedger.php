<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccSubSubLedger extends Model
{
    use HasFactory;

    protected $primaryKey = 'sub_sub_ledger_id';
    public static $subsubLedger;

    public static function storeSubSubLedger($request)
    {
        self::$subsubLedger = new AccSubSubLedger();
        self::$subsubLedger->sub_sub_ledger_id      = $request->sub_sub_ledger_id;
        self::$subsubLedger->sub_sub_ledger_name    = $request->sub_sub_ledger_name;
        self::$subsubLedger->sub_ledger_id          = $request->sub_ledger_id;
        self::$subsubLedger->status                 = 1;
        self::$subsubLedger->sconid                    = 1;
        self::$subsubLedger->pcomid                    = 1;
        self::$subsubLedger->entry_by                  = $request->entry_by;
        self::$subsubLedger->save();

    }

    public function accSubLedgerGetforSubSubLedger()
    {
        return $this->belongsTo(AccSubLedger::class,'sub_ledger_id','sub_ledger_id');
    }
}

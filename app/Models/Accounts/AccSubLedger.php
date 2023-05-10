<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccSubLedger extends Model
{
    use HasFactory;
    public static $subLedger;


    public static function storeSubLedger($request)
    {
        self::$subLedger = new AccSubLedger();
        self::$subLedger->ledger_id = $request->ledger_id;
        self::$subLedger->sub_ledger_id = $request->sub_ledger_id;
        self::$subLedger->sub_ledger_name = $request->sub_ledger_name;
        self::$subLedger->status = 1;
        self::$subLedger->sconid = 1;
        self::$subLedger->pcomid = 1;
        self::$subLedger->entry_by = $request->entry_by;
        self::$subLedger->save();

    }
}

<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccLedger extends Model
{
    use HasFactory;

    public static $ledgers;

    public function accLedgerGroup()
    {
        return $this->belongsTo(AccLedgerGroup::class , 'group_id', 'group_id');
    }
    public function accSubClass()
    {
        return $this->belongsTo(AccSubClass::class, 'sub_class_id', 'sub_class_id');
    }
    public function accClass()
    {
        return $this->belongsTo(AccClass::class, 'class_id', 'class_id');
    }

    public static function storeLedger($request)
    {
        self::$ledgers = new AccLedger();
        self::$ledgers->ledger_id = $request->ledger_id;
        self::$ledgers->ledger_name = $request->ledger_name;
        self::$ledgers->group_id = $request->group_id;
        self::$ledgers->sub_class_id = '199';
        self::$ledgers->class_id = 790;
        self::$ledgers->status = '1';
        self::$ledgers->sconid = '1';
        self::$ledgers->pcomid = '1';
        self::$ledgers->entry_by = $request->entry_by;
        self::$ledgers->save();
    }

    public static function updateLedger($request, $id)
    {
        self::$ledgers = AccLedger::find($id);
        self::$ledgers->ledger_id = $request->ledger_id;
        self::$ledgers->ledger_name = $request->ledger_name;
        self::$ledgers->group_id = $request->group_id;
        self::$ledgers->sub_class_id = '199';
        self::$ledgers->class_id = '1899';
        self::$ledgers->status = '1';
        self::$ledgers->sconid = '1';
        self::$ledgers->pcomid = '1';
        self::$ledgers->entry_by = $request->entry_by;
        self::$ledgers->save();
    }

    public static function destroyLedger($id)
    {
        self::$ledgers = AccLedger::find($id) ;
        self::$ledgers->delete();
    }


}

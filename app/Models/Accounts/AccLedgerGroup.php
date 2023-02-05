<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccLedgerGroup extends Model
{
    use HasFactory;

    public static $ledgerGroup;
    public static function storeLedgerGroup($request)
    {
        self::$ledgerGroup = new AccLedgerGroup();
        self::$ledgerGroup->group_id = $request->group_id;
        self::$ledgerGroup->group_name = $request->group_name;
        self::$ledgerGroup->sub_class_id = $request->sub_class_id;
        self::$ledgerGroup->class_id = $request->class_id;
        self::$ledgerGroup->status = 1;
        self::$ledgerGroup->entry_by = $request->entry_by;
        self::$ledgerGroup->sconid = 1;
        self::$ledgerGroup->pcomid = 1;
        self::$ledgerGroup->save();

    }

    public static function updateLedgerGroup($request, $id)
    {
        self::$ledgerGroup = AccLedgerGroup::find($id);
        self::$ledgerGroup->group_id = $request->group_id;
        self::$ledgerGroup->group_name = $request->group_name;
        self::$ledgerGroup->sub_class_id = $request->sub_class_id;
        self::$ledgerGroup->class_id = $request->class_id;
        self::$ledgerGroup->status = $request->status;
        self::$ledgerGroup->entry_by = $request->entry_by;
        self::$ledgerGroup->sconid = 1;
        self::$ledgerGroup->pcomid = 1;
        self::$ledgerGroup->save();
    }

    public static function destroyLedgerGroup($id)
    {
        AccLedgerGroup::find($id);
        self::$ledgerGroup->delete();
    }

    public function accClass()
    {
        return $this->belongsTo(AccClass::class, 'class_id', 'class_id');
    }

    public function accSubClass()
    {
        return $this->belongsTo(AccSubClass::class, 'sub_class_id', 'sub_class_id');
    }
}

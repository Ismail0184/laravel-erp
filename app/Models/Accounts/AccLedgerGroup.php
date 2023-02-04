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
        //self::$ledgerGroup->
    }

    public static function updateLedgerGroup($request, $id)
    {

    }

    public static function destroyLedgerGroup($id)
    {
        AccLedgerGroup::find($id);
        self::$ledgerGroup->delete();
    }

    public function accClass()
    {
        return $this->belongsTo(AccClass::class, 'class_id');
    }

    public function AccSubClass()
    {
        return $this->belongsTo(AccSubClass::class, 'acc_sub_class');
    }
}

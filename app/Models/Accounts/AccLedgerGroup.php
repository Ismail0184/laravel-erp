<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Termwind\renderUsing;

class AccLedgerGroup extends Model
{
    use HasFactory;
    protected $primaryKey = 'group_id';
    public static $ledgerGroup;

    public static function next_group_id($class_id)
    {
        $max=(ceil(($class_id+1)/1000))*1000;
        $min=$class_id;

        $maxIdInDatabase = AccLedgerGroup::where('group_id','>',$min)->where('group_id','<',$max)->where('class_id','=',$class_id)->max('group_id');
        if($maxIdInDatabase>0)
            $group_id=$maxIdInDatabase+1;
        else
            $group_id=$min+1;
        return $group_id;
    }

    public static function storeLedgerGroup($request)
    {
        self::$ledgerGroup = new AccLedgerGroup();
        self::$ledgerGroup->group_id = self::next_group_id($request->class_id);
        self::$ledgerGroup->group_name = $request->group_name;
        self::$ledgerGroup->sub_class_id = $request->sub_class_id;
        self::$ledgerGroup->class_id = $request->class_id;
        self::$ledgerGroup->status = 1;
        self::$ledgerGroup->entry_by = $request->entry_by;
        self::$ledgerGroup->update_by = 0;
        self::$ledgerGroup->sconid = 1;
        self::$ledgerGroup->pcomid = 1;
        self::$ledgerGroup->save();

    }

    public static function updateLedgerGroup($request, $id)
    {
        self::$ledgerGroup = AccLedgerGroup::find($id);
        self::$ledgerGroup->group_name = $request->group_name;
        self::$ledgerGroup->status = $request->status;
        self::$ledgerGroup->update_by = $request->entry_by;
        self::$ledgerGroup->sconid = 1;
        self::$ledgerGroup->pcomid = 1;
        self::$ledgerGroup->save();
    }

    public static function destroyLedgerGroup($id)
    {
        self::$ledgerGroup = AccLedgerGroup::find($id);
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

    public function getAccLedger()
    {
        return $this->hasMany(AccLedger::class,'group_id','group_id')->where('type','ledger')->orderBy('ledger_id');
    }
}

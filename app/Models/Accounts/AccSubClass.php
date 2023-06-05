<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccSubClass extends Model
{
    use HasFactory;

    protected $primaryKey = 'sub_class_id';

    public static $subclasses;

    public static function storeSubClass($request)
    {
        self::$subclasses                   = new AccSubClass();
        self::$subclasses->class_id         = $request->class_id;
        self::$subclasses->sub_class_name   = $request->sub_class_name;
        self::$subclasses->status           = 1;
        self::$subclasses->sconid           = 1;
        self::$subclasses->pcomid           = 1;
        self::$subclasses->entry_by         = $request->entry_by ;
        self::$subclasses->update_by        = 0;
        self::$subclasses->save();
    }

    public static function updateSubClass($request, $id)
    {
        self::$subclasses = AccSubClass::find($id);
        self::$subclasses->sub_class_name   = $request->sub_class_name;
        self::$subclasses->status           = $request->status;
        self::$subclasses->sconid           = 1;
        self::$subclasses->pcomid           = 1;
        self::$subclasses->update_by         = $request->entry_by ;
        self::$subclasses->save();
    }

    public static function destroySubClass($id)
    {
        self::$subclasses = AccSubClass::find($id);
        self::$subclasses->delete();
    }

    public function accClass()
    {
        return $this->belongsTo(AccClass::class, 'class_id', 'class_id');
    }


}

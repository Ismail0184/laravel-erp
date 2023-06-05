<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccClass extends Model
{
    use HasFactory;

    protected $primaryKey = 'class_id';

    public static $classes;

    public static function storeClass($request)
    {
        self::$classes = new AccClass();
        self::$classes->statement    = $request->statement;
        self::$classes->class_id    = $request->class_id;
        self::$classes->class_name  = $request->class_name;
        self::$classes->status      = 1;
        self::$classes->sconid      = 1;
        self::$classes->pcomid      = 1;
        self::$classes->entry_by    = $request->entry_by;
        self::$classes->save();

    }

    public static function updateClass($request, $id)
    {
        self::$classes = AccClass::find($id);
        self::$classes->class_id = $request->class_id;
        self::$classes->class_name = $request->class_name;
        self::$classes->status = $request->status;
        self::$classes->save();
    }

    public static function destroyClass($id)
    {
        self::$classes = AccClass::find($id);
        self::$classes->delete();
    }
}

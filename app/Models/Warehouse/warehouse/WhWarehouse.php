<?php

namespace App\Models\Warehouse\warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhWarehouse extends Model
{
    use HasFactory;
    protected $primaryKey = 'warehouse_id';

    public static $warehouse;

    public static function storeWarehouse($request)
    {
        self::$warehouse = new WhWarehouse();
        self::$warehouse->warehouse_name = $request->warehouse_name;
        self::$warehouse->nick_name = $request->nick_name;
        self::$warehouse->address = $request->address;
        self::$warehouse->VMS_address = $request->VMS_address;
        self::$warehouse->poc_name = $request->poc_name;
        self::$warehouse->poc_designation = $request->poc_designation;
        self::$warehouse->poc_number = $request->poc_number;
        self::$warehouse->poc_email = $request->poc_email;
        self::$warehouse->use_type = $request->use_type;
        self::$warehouse->status = 'active';
        self::$warehouse->ledger_id = $request->ledger_id;
        self::$warehouse->ledger_id_RM = $request->ledger_id;
        self::$warehouse->ledger_id_FG = $request->ledger_id;
        self::$warehouse->sconid = 1;
        self::$warehouse->pcomid = 1;
        self::$warehouse->save();
    }

    public static function updateWarehouse($request, $id)
    {
        self::$warehouse = WhWarehouse::find($id);
        self::$warehouse->warehouse_name = $request->warehouse_name;
        self::$warehouse->nick_name = $request->nick_name;
        self::$warehouse->address = $request->address;
        self::$warehouse->VMS_address = $request->VMS_address;
        self::$warehouse->poc_name = $request->poc_name;
        self::$warehouse->poc_designation = $request->poc_designation;
        self::$warehouse->poc_number = $request->poc_number;
        self::$warehouse->poc_email = $request->poc_email;
        self::$warehouse->use_type = $request->use_type;
        self::$warehouse->status = 'active';
        self::$warehouse->ledger_id = $request->ledger_id;
        self::$warehouse->ledger_id_RM = $request->ledger_id;
        self::$warehouse->ledger_id_FG = $request->ledger_id;
        self::$warehouse->sconid = 1;
        self::$warehouse->pcomid = 1;
        self::$warehouse->save();
    }

    public static function destroyWarehouse($id)
    {
        self::$warehouse = WhWarehouse::find($id);
        self::$warehouse->status = 'deleted';
        self::$warehouse->save();
    }
}

<?php

namespace App\Models\Procurement\workorder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class ProPurchaseMaster extends Model
{
    use HasFactory;

    protected $primaryKey = 'po_no';

    public static $po;

    public static function initiateDirectPurchase($request)
    {
        self::$po = new ProPurchaseMaster();
        self::$po->po_no = $request->po_no;
        self::$po->po_date = $request->po_date;
        self::$po->po_subject = 0;
        self::$po->po_details = 0;
        self::$po->quotation_no = 0;
        self::$po->quotation_date = $request->po_date;
        self::$po->vendor_id = $request->vendor_id;
        self::$po->warehouse_id = $request->warehouse_id;
        self::$po->tax = $request->tax;
        self::$po->vat = $request->vat;
        self::$po->po_type = $request->po_type;
        self::$po->status = $request->status;
        self::$po->entry_by = $request->entry_by;
        self::$po->entry_at = $request->entry_at;
        self::$po->ip = 1;
        self::$po->mac = $request->mac;
        self::$po->sconid = 1;
        self::$po->pcomid = 1;
        self::$po->save();
        Session::put('po_no', $request->po_no);
    }

    public static function destroyPO($id)
    {
        self::$po = ProPurchaseMaster::find($id);
        self::$po->delete();
    }

    public static function confirmWorkOrder($request, $id)
    {
        self::$po = ProPurchaseMaster::findOrFail($id);
        self::$po->status = $request->status;
        self::$po->save();
    }
}

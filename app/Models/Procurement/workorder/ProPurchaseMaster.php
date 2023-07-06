<?php

namespace App\Models\Procurement\workorder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProPurchaseMaster extends Model
{
    use HasFactory;

    public static $po;

    public static function initiateDirectPurchase($request)
    {
        self::$po = new ProPurchaseMaster();
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
        self::$po->checked_by = 0;
        self::$po->checked_at = $request->checked_at;
        self::$po->approved_by = 0;
        self::$po->approved_at = '';
        self::$po->audited_by = 0;
        self::$po->audited_at = '';
        self::$po->deleted_resone = '';
        self::$po->deleted_by = 0;
        self::$po->deleted_at = '';
        self::$po->ip = 1;
        self::$po->mac = $request->mac;
        self::$po->sconid = 1;
        self::$po->pcomid = 1;
        self::$po->save();
    }
}

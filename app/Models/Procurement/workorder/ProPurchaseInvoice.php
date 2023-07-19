<?php

namespace App\Models\Procurement\workorder;

use App\Models\Accounts\Products\AccProductItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProPurchaseInvoice extends Model
{
    use HasFactory;

    public static $invoice;
    public static function storeInvoice($request)
    {
        self::$invoice = new ProPurchaseInvoice();
        self::$invoice->po_no = $request->po_no;
        self::$invoice->po_date = $request->po_date;
        self::$invoice->vendor_id = $request->vendor_id;
        self::$invoice->item_id = $request->item_id;
        self::$invoice->item_details = $request->item_details;
        self::$invoice->warehouse_id = $request->warehouse_id;
        self::$invoice->qty = $request->qty;
        self::$invoice->rate = $request->rate;
        self::$invoice->amount = $request->amount;
        self::$invoice->po_type = $request->po_type;
        self::$invoice->status = 'MANUAL';
        self::$invoice->entry_by = $request->entry_by;
        self::$invoice->sconid = '1';
        self::$invoice->pcomid = '1';
        self::$invoice->save();
    }

    public static function updateInvoice($request, $id)
    {
        self::$invoice = ProPurchaseInvoice::find($id);
        self::$invoice->po_no = $request->po_no;
        self::$invoice->po_date = $request->po_date;
        self::$invoice->vendor_id = $request->vendor_id;
        self::$invoice->item_id = $request->item_id;
        self::$invoice->item_details = $request->item_details;
        self::$invoice->warehouse_id = $request->warehouse_id;
        self::$invoice->qty = $request->qty;
        self::$invoice->rate = $request->rate;
        self::$invoice->amount = $request->amount;
        self::$invoice->po_type = $request->po_type;
        self::$invoice->status = 'MANUAL';
        self::$invoice->entry_by = $request->entry_by;
        self::$invoice->sconid = '1';
        self::$invoice->pcomid = '1';
        self::$invoice->save();
    }

    public static function destroyInvoice($id)
    {
        self::$invoice = ProPurchaseInvoice::find($id);
        self::$invoice->delete();
    }

    public static function destroyInvoiceAll($id)
    {
        self::$invoice = ProPurchaseInvoice::where('po_no', $id);
        self::$invoice->delete();
    }

    public static function confirmInvoice($request, $id)
    {
        ProPurchaseInvoice::where('po_no',$id)->update(['status'=>$request->status]);
    }

    public function item()
    {
        return $this->belongsTo(AccProductItem::class,'item_id','item_id');
    }

}

<?php

namespace App\Models\Procurement\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProVendorInfo extends Model
{
    use HasFactory;

    protected $primaryKey = 'vendor_id';
    public static $vendorinfo;

    public static function storeVendor($request)
    {
        self::$vendorinfo = new ProVendorInfo();
        self::$vendorinfo->ledger_id = $request->ledger_id;
        self::$vendorinfo->vendor_name = $request->vendor_name;
        self::$vendorinfo->address = $request->address;
        self::$vendorinfo->contact_no = $request->contact_no;
        self::$vendorinfo->email = $request->email;
        self::$vendorinfo->TIN = $request->TIN;
        self::$vendorinfo->BIN = $request->BIN;
        self::$vendorinfo->poc_name = $request->poc_name;
        self::$vendorinfo->poc_designation = $request->poc_designation;
        self::$vendorinfo->poc_mobile = $request->poc_mobile;
        self::$vendorinfo->poc_email = $request->poc_email;
        self::$vendorinfo->status = 'active';
        self::$vendorinfo->category = $request->category;
        self::$vendorinfo->entry_by = $request->entry_by;
        self::$vendorinfo->sconid = 1;
        self::$vendorinfo->pcomid = 1;
        self::$vendorinfo->save();
    }

    public static function updateVendor($request,$id)
    {
        self::$vendorinfo = ProVendorInfo::find($id);
        self::$vendorinfo->ledger_id = $request->ledger_id;
        self::$vendorinfo->vendor_name = $request->vendor_name;
        self::$vendorinfo->address = $request->address;
        self::$vendorinfo->contact_no = $request->contact_no;
        self::$vendorinfo->email = $request->email;
        self::$vendorinfo->TIN = $request->TIN;
        self::$vendorinfo->BIN = $request->BIN;
        self::$vendorinfo->poc_name = $request->poc_name;
        self::$vendorinfo->poc_designation = $request->poc_designation;
        self::$vendorinfo->poc_mobile = $request->poc_mobile;
        self::$vendorinfo->poc_email = $request->poc_email;
        self::$vendorinfo->status = $request->status;
        self::$vendorinfo->category = $request->category;
        self::$vendorinfo->save();
    }

    public static function destroyVendor($id)
    {
        self::$vendorinfo = ProVendorInfo::find($id);
        self::$vendorinfo->status = 'deleted';
        self::$vendorinfo->save();
    }

    public function getCategory()
    {
        return $this->belongsTo(ProVendorCategory::class,'category','id');
    }
}

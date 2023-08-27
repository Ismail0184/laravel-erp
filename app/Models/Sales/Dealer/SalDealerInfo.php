<?php

namespace App\Models\Sales\Dealer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalDealerInfo extends Model
{
    use HasFactory;

    public static $dealer_info;

    public static function storeDealer($request)
    {
        self::$dealer_info = new SalDealerInfo();
        self::$dealer_info->serial = $request->serial;
        self::$dealer_info->dealer_custom_id = $request->dealer_custom_id;
        self::$dealer_info->dealer_name = $request->dealer_name;
        self::$dealer_info->proprietor_name = $request->proprietor_name;
        self::$dealer_info->mobile = $request->mobile;
        self::$dealer_info->email = $request->email;
        self::$dealer_info->contact_person = $request->contact_person;
        self::$dealer_info->contact_person_designation = $request->contact_person_designation;
        self::$dealer_info->contact_person_mobile = $request->contact_person_mobile;
        self::$dealer_info->address = $request->address;
        self::$dealer_info->nid = $request->nid;
        self::$dealer_info->passport = $request->passport;
        self::$dealer_info->TIN = $request->TIN;
        self::$dealer_info->BIN = $request->BIN;
        self::$dealer_info->ledger_id = $request->ledger_id;
        self::$dealer_info->region_id = $request->region_id;
        self::$dealer_info->area_id = $request->area_id;
        self::$dealer_info->territory_id = $request->territory_id;
        self::$dealer_info->town_id = $request->town_id;
        self::$dealer_info->category_id = $request->category_id;
        self::$dealer_info->type_id = $request->type_id;
        self::$dealer_info->commission = $request->commission;
        self::$dealer_info->status = 'active';
        self::$dealer_info->entry_by = $request->entry_by;
        self::$dealer_info->sconid = 1;
        self::$dealer_info->pcomid = 1;
        self::$dealer_info->save();
    }
}

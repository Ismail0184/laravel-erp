<?php

namespace App\Models\Sales\Dealer;

use App\Models\Sales\DistributionSetup\SalArea;
use App\Models\Sales\DistributionSetup\SalRegion;
use App\Models\Sales\DistributionSetup\SalTerritory;
use App\Models\Sales\DistributionSetup\SalTown;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalDealerInfo extends Model
{
    use HasFactory;

    protected $primaryKey = 'dealer_id';
    public static $dealer_info;

    public static function getArea($territory_id)
    {
        $area_id = SalTerritory::where('territory_id', $territory_id)->value('area_id');
        return $area_id;

    }
    public static function getRegion($territory_id)
    {
        $area_id = SalTerritory::where('territory_id', $territory_id)->value('area_id');
        $region_id = SalArea::where('area_id', $area_id)->value('region_id');
        return $region_id;

    }


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
        self::$dealer_info->region_id = self::getRegion($request->territory_id);
        self::$dealer_info->area_id = self::getArea($request->territory_id);
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

    public static function updateDealer($request,$id)
    {
        self::$dealer_info                      = SalDealerInfo::findOrFail($id);
        self::$dealer_info->serial              = $request->serial;
        self::$dealer_info->dealer_custom_id    = $request->dealer_custom_id;
        self::$dealer_info->dealer_name         = $request->dealer_name;
        self::$dealer_info->proprietor_name     = $request->proprietor_name;
        self::$dealer_info->mobile              = $request->mobile;
        self::$dealer_info->email               = $request->email;
        self::$dealer_info->contact_person      = $request->contact_person;
        self::$dealer_info->contact_person_designation = $request->contact_person_designation;
        self::$dealer_info->contact_person_mobile = $request->contact_person_mobile;
        self::$dealer_info->address             = $request->address;
        self::$dealer_info->nid                 = $request->nid;
        self::$dealer_info->passport            = $request->passport;
        self::$dealer_info->TIN                 = $request->TIN;
        self::$dealer_info->BIN                 = $request->BIN;
        self::$dealer_info->ledger_id           = $request->ledger_id;
        self::$dealer_info->region_id           = self::getRegion($request->territory_id);
        self::$dealer_info->area_id             = self::getArea($request->territory_id);
        self::$dealer_info->territory_id        = $request->territory_id;
        self::$dealer_info->town_id             = $request->town_id;
        self::$dealer_info->category_id         = $request->category_id;
        self::$dealer_info->type_id             = $request->type_id;
        self::$dealer_info->commission          = $request->commission;
        self::$dealer_info->status              = $request->status;
        self::$dealer_info->entry_by            = $request->entry_by;
        self::$dealer_info->save();
    }

    public static function destroyDealer($id)
    {
        SalDealerInfo::where('dealer_id',$id)->update(['status'=>'deleted']);
    }

    public function territory()
    {
        return $this->belongsTo(SalTerritory::class, 'territory_id','territory_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'entry_by','id');
    }

    public function town()
    {
        return $this->belongsTo(SalTown::class,'town_id','town_id');
    }

    public function category()
    {
        return $this->belongsTo(SalDealerCategory::class,'category_id','cat_id');
    }
    public function type()
    {
        return $this->belongsTo(SalDealerType::class,'type_id','type_id');
    }
    public function region()
    {
        return $this->belongsTo(SalRegion::class, 'region_id','region_id');
    }
    public function area()
    {
        return $this->belongsTo(SalArea::class, 'area_id','area_id');
    }
}

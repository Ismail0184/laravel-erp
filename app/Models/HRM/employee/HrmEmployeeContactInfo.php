<?php

namespace App\Models\HRM\employee;

use App\Models\HRM\setup\HrmCity;
use App\Models\HRM\setup\HrmPoliceStation;
use App\Models\HRM\setup\HrmPostOffice;
use App\Models\HRM\setup\HrmState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEmployeeContactInfo extends Model
{
    use HasFactory;

    public static $employee;


    public static function storeEmployeeContactInfo($request)
    {
        self::$employee = new HrmEmployeeContactInfo();
        self::$employee->employee_id = $request->employee_id;
        self::$employee->mobile = $request->mobile;
        self::$employee->alternative_mobile = $request->alternative_mobile;
        self::$employee->email = $request->email;
        self::$employee->present_address = $request->present_address;
        self::$employee->present_address_country = $request->present_address_country;
        self::$employee->present_address_state = $request->present_address_state;
        self::$employee->present_address_city = $request->present_address_city;
        self::$employee->present_address_police_station = $request->present_address_police_station;
        self::$employee->present_address_post_office = $request->present_address_post_office;
        self::$employee->present_address_zip_code = $request->present_address_zip_code;
        self::$employee->permanent_address = $request->permanent_address;
        self::$employee->permanent_address_country = $request->permanent_address_country;
        self::$employee->permanent_address_state = $request->permanent_address_state;
        self::$employee->permanent_address_city = $request->permanent_address_city;
        self::$employee->permanent_address_police_station = $request->permanent_address_police_station;
        self::$employee->permanent_address_post_office = $request->permanent_address_post_office;
        self::$employee->permanent_address_zip_code = $request->permanent_address_zip_code;
        self::$employee->entry_by = $request->entry_by;
        self::$employee->sconid = 1;
        self::$employee->pcomid = 1;
        self::$employee->save();
    }

    public static function updateEmployeeContactInfo($request, $id)
    {
        self::$employee = HrmEmployeeContactInfo::where('employee_id', $id)->firstOrfail();;
        self::$employee->employee_id = $request->employee_id;
        self::$employee->mobile = $request->mobile;
        self::$employee->alternative_mobile = $request->alternative_mobile;
        self::$employee->email = $request->email;
        self::$employee->present_address = $request->present_address;
        self::$employee->present_address_country = $request->present_address_country;
        self::$employee->present_address_state = $request->present_address_state;
        self::$employee->present_address_city = $request->present_address_city;
        self::$employee->present_address_police_station = $request->present_address_police_station;
        self::$employee->present_address_post_office = $request->present_address_post_office;
        self::$employee->present_address_zip_code = $request->present_address_zip_code;
        self::$employee->permanent_address = $request->permanent_address;
        self::$employee->permanent_address_country = $request->permanent_address_country;
        self::$employee->permanent_address_state = $request->permanent_address_state;
        self::$employee->permanent_address_city = $request->permanent_address_city;
        self::$employee->permanent_address_police_station = $request->permanent_address_police_station;
        self::$employee->permanent_address_post_office = $request->permanent_address_post_office;
        self::$employee->permanent_address_zip_code = $request->permanent_address_zip_code;
        self::$employee->updated_by = $request->entry_by;
        self::$employee->sconid = 1;
        self::$employee->pcomid = 1;
        self::$employee->save();
    }

    public static function destroyEmployee($id)
    {
        self::$employee = HrmEmployee::find($id);
        if (file_exists(self::$employee->image))
        {
            unlink(self::$employee->image);
        }
        self::$employee->delete();
    }

    public function presentAddressPO()
    {
        return $this->belongsTo(HrmPostOffice::class, 'present_address_post_office','id');
    }
    public function presentAddressPS()
    {
        return $this->belongsTo(HrmPoliceStation::class,'present_address_police_station','id');
    }
    public function presentAddressCity()
    {
        return $this->belongsTo(HrmCity::class,'present_address_city','id');
    }
    public function presentAddressState()
    {
        return $this->belongsTo(HrmState::class,'present_address_state','id');
    }

    public function permanentAddressPO()
    {
        return $this->belongsTo(HrmPostOffice::class, 'present_address_post_office','id');
    }
    public function permanentAddressPS()
    {
        return $this->belongsTo(HrmPoliceStation::class,'present_address_police_station','id');
    }
    public function permanentAddressCity()
    {
        return $this->belongsTo(HrmCity::class,'present_address_city','id');
    }
    public function permanentAddressState()
    {
        return $this->belongsTo(HrmState::class,'present_address_state','id');
    }


}

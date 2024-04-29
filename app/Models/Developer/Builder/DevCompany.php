<?php

namespace App\Models\Developer\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevCompany extends Model
{
    use HasFactory;

    public static $company, $image, $imageName, $directory, $imageUrl;

    public static function getImageUrl($request)
    {
        self::$image        = $request->file('image');
        self::$imageName    = self::$image->getClientOriginalName();
        self::$directory    = 'assets/companies/logo/';
        self::$image->move(self::$directory, self::$imageName);
        return self::$directory.self::$imageName;
    }

    public static function storeCompany($request)
    {
        self::$company = new DevCompany();
        self::$company->group_id            = $request->group_id;
        self::$company->company_name        = $request->company_name;
        self::$company->address             = $request->address;
        self::$company->website             = $request->website;
        self::$company->telephone           = $request->telephone;
        self::$company->trade_license       = $request->trade_license;
        self::$company->VAT_registration    = $request->VAT_registration;
        self::$company->TIN                 = $request->TIN;
        self::$company->BIN                 = $request->BIN;
        self::$company->logo                = self::getImageUrl($request);
        self::$company->logo_color          = $request->logo_color;
        self::$company->save();
    }

    public static function updateCompany($request, $id)
    {
        self::$company = DevCompany::findOrfail($id);
        if ($request->file('image'))
        {
            if (file_exists(self::$company->logo))
            {
                unlink(self::$company->logo);
            }
            self::$imageUrl = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$company->image;
        }
        self::$company->group_id            = $request->group_id;
        self::$company->company_name        = $request->company_name;
        self::$company->address             = $request->address;
        self::$company->website             = $request->website;
        self::$company->telephone           = $request->telephone;
        self::$company->trade_license       = $request->trade_license;
        self::$company->VAT_registration    = $request->VAT_registration;
        self::$company->TIN                 = $request->TIN;
        self::$company->BIN                 = $request->BIN;
        if ($request->file('image')) {
            self::$company->logo = self::$imageUrl;
        }
        self::$company->logo_color          = $request->logo_color;
        self::$company->save();
    }

    public static function destroyCompany($id)
    {
        DevCompany::where('id',$id)->update(['status'=>'deleted']);
    }


    public function getGroup()
    {
        return $this->belongsTo(DevGroup::class,'group_id','group_id');
    }
}

<?php

namespace App\Models\HRM\employee;

use App\Models\HRM\setup\HrmBlood;
use App\Models\HRM\setup\HrmGender;
use App\Models\HRM\setup\HrmGrade;
use App\Models\HRM\setup\HrmNationality;
use App\Models\HRM\setup\HrmReligion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEmployee extends Model
{
    use HasFactory;

    public static $employee,$image, $imageName, $directory, $imageUrl;


    public static function getImageUrl($request)
    {
        self::$image        = $request->file('image');
        self::$imageName    = self::$image->getClientOriginalName();
        self::$directory    = 'assets/images/employee/';
        self::$image->move(self::$directory, self::$imageName);
        return self::$directory.self::$imageName;
    }

    public static function storeEmployee($request)
    {
        self::$employee = new HrmEmployee();
        self::$employee->code = $request->code;
        self::$employee->full_name = $request->full_name;
        self::$employee->father_name = $request->father_name;
        self::$employee->mother_name = $request->mother_name;
        self::$employee->spouse_name = $request->spouse_name;
        self::$employee->date_of_birth = $request->date_of_birth;
        self::$employee->blood_group = $request->blood_group;
        self::$employee->gender = $request->gender;
        self::$employee->religion = $request->religion;
        self::$employee->marital_status = $request->marital_status;
        self::$employee->nationality = $request->nationality;
        self::$employee->national_id = $request->national_id;
        self::$employee->birth_certificate_id = $request->birth_certificate_id;
        self::$employee->passport_id = $request->passport_id;
        self::$employee->driving_license = $request->driving_license;
        self::$employee->entry_by = $request->entry_by;
        self::$employee->image = self::getImageUrl($request);
        self::$employee->sconid = 1;
        self::$employee->pcomid = 1;
        self::$employee->save();
    }

    public static function updateEmployee($request, $id)
    {
        self::$employee = HrmEmployee::findOrfail($id);
        if ($request->file('image'))
        {
            if (file_exists(self::$employee->image))
            {
                unlink(self::$employee->image);
            }
            self::$imageUrl = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$employee->image;
        }
        self::$employee->code = $request->code;
        self::$employee->full_name = $request->full_name;
        self::$employee->father_name = $request->father_name;
        self::$employee->mother_name = $request->mother_name;
        self::$employee->spouse_name = $request->spouse_name;
        self::$employee->date_of_birth = $request->date_of_birth;
        self::$employee->blood_group = $request->blood_group;
        self::$employee->gender = $request->gender;
        self::$employee->religion = $request->religion;
        self::$employee->marital_status = $request->marital_status;
        self::$employee->nationality = $request->nationality;
        self::$employee->national_id = $request->national_id;
        self::$employee->birth_certificate_id = $request->birth_certificate_id;
        self::$employee->passport_id = $request->passport_id;
        self::$employee->driving_license = $request->driving_license;
        self::$employee->entry_by = $request->entry_by;
        self::$employee->image = self::$imageUrl;
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

    public function bloodgroup()
    {
        return $this->belongsTo(HrmBlood::class, 'blood_group','id');
    }
    public function religions()
    {
        return $this->belongsTo(HrmReligion::class, 'religion','id');
    }

    public function genders()
    {
        return $this->belongsTo(HrmGender::class, 'gender','id');
    }

    public function getNationality()
    {
        return $this->belongsTo(HrmNationality::class,'nationality','num_code');
    }
}

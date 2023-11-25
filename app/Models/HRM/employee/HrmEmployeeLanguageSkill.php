<?php

namespace App\Models\HRM\employee;

use App\Models\HRM\setup\HrmLanaguageProficiencyLevel;
use App\Models\HRM\setup\HrmLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEmployeeLanguageSkill extends Model
{
    use HasFactory;

    public static $language;

    public static function storeLanguageSkillInfo($request)
    {
        self::$language = new HrmEmployeeLanguageSkill();
        self::$language->employee_id = $request->employee_id;
        self::$language->language_id = $request->language_id;
        self::$language->proficiency_id = $request->proficiency_id;
        self::$language->entry_by = $request->entry_by;
        self::$language->sconid = 1;
        self::$language->pcomid = 1;
        self::$language->save();
    }

    public static function destroyLanguageSkillInfo($id)
    {
        self::$language = HrmEmployeeLanguageSkill::findOrfail($id);
        self::$language->delete();
    }

    public function languageName()
    {
        return $this->belongsTo(HrmLanguage::class, 'language_id','id');
    }

    public function proficiencyLevel()
    {
        return $this->belongsTo(HrmLanaguageProficiencyLevel::class, 'proficiency_id','id');
    }
}

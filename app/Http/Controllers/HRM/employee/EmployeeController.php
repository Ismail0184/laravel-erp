<?php

namespace App\Http\Controllers\HRM\employee;

use App\Http\Controllers\Controller;
use App\Models\HRM\employee\HrmEmployee;
use App\Models\HRM\employee\HrmEmployeeBankAccountInfo;
use App\Models\HRM\employee\HrmEmployeeContactInfo;
use App\Models\HRM\employee\HrmEmployeeDocumentInfo;
use App\Models\HRM\employee\HrmEmployeeEducationInfo;
use App\Models\HRM\employee\HrmEmployeeEmployment;
use App\Models\HRM\employee\HrmEmployeeFamilyInfo;
use App\Models\HRM\employee\HrmEmployeeJobInfo;
use App\Models\HRM\employee\HrmEmployeeLanguage;
use App\Models\HRM\employee\HrmEmployeeLanguageSkill;
use App\Models\HRM\employee\HrmEmployeeSocialMediaInfo;
use App\Models\HRM\employee\HrmEmployeeSupervisorInfo;
use App\Models\HRM\employee\HrmEmployeeTalentInfo;
use App\Models\HRM\setup\HrmBank;
use App\Models\HRM\setup\HrmBlood;
use App\Models\HRM\setup\HrmCity;
use App\Models\HRM\setup\HrmDepartment;
use App\Models\HRM\setup\HrmDesignation;
use App\Models\HRM\setup\HrmDocumentCategory;
use App\Models\HRM\setup\HrmEduExamTitle;
use App\Models\HRM\setup\HrmEduSubject;
use App\Models\HRM\setup\HrmEmploymentType;
use App\Models\HRM\setup\HrmGrade;
use App\Models\HRM\setup\HrmJobLocation;
use App\Models\HRM\setup\HrmLanaguageProficiencyLevel;
use App\Models\HRM\setup\HrmLanguage;
use App\Models\HRM\setup\HrmNationality;
use App\Models\HRM\setup\HrmPoliceStation;
use App\Models\HRM\setup\HrmPostOffice;
use App\Models\HRM\setup\HrmRelation;
use App\Models\HRM\setup\HrmReligion;
use App\Models\HRM\setup\HrmShift;
use App\Models\HRM\setup\HrmSocialMedia;
use App\Models\HRM\setup\HrmState;
use App\Models\HRM\setup\HrmTalent;
use App\Models\HRM\setup\HrmUniversity;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = HrmEmployee::all();
        return view('modules.hrm.employee.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bloods = HrmBlood::where('status','active')->get();
        $religions = HrmReligion::where('status','active')->get();
        return view('modules.hrm.employee.create',compact(['bloods','religions']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HrmEmployee::storeEmployee($request);
        return redirect('/hrm/employee/')->with('store_message','A new employee has been successfully inserted!!');
    }

    public function contactInformationStore(Request $request)
    {
        HrmEmployeeContactInfo::storeEmployeeContactInfo($request);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'contact');
    }

    public function jobInfoStore(Request $request)
    {
        HrmEmployeeJobInfo::storeJobInfo($request);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'job')->with('job_store_message',' --> job has been added!!');
    }
    public function familyInfoStore(Request $request)
    {
        HrmEmployeeFamilyInfo::storeFamilyInfo($request);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'family')->with('family_store_message',' --> family has been added!!');
    }

    public function educationInfoStore(Request $request)
    {
        HrmEmployeeEducationInfo::storeEducationInfo($request);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'education')->with('education_store_message',' --> has been added!!');
    }

    public function employmentInfoStore(Request $request)
    {
        HrmEmployeeEmployment::storeEmploymentInfo($request);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'employment')->with('employment_store_message',' --> has been added!!');
    }

    public function supervisorInfoStore(Request $request)
    {
        HrmEmployeeSupervisorInfo::storeSupervisorInfo($request);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'supervisor')->with('supervisor_store_message',' --> has been added!!');
    }

    public function documentInfoStore(Request $request)
    {
        HrmEmployeeDocumentInfo::storeDocumentInfo($request);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'document')->with('document_store_message',' --> has been added!!');
    }

    public function languageInfoStore(Request $request)
    {
        HrmEmployeeLanguageSkill::storeLanguageSkillInfo($request);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'language')->with('language_store_message',' --> has been added!!');
    }

    public function bankAccountInfoStore(Request $request)
    {
        HrmEmployeeBankAccountInfo::storeBankAccountInfo($request);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'bank')->with('bank_store_message',' --> has been added!!');
    }

    public function socialMediaInfoStore(Request $request)
    {
        HrmEmployeeSocialMediaInfo::storeSocialMediaInfo($request);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'social')->with('social_store_message',' --> has been added!!');
    }

    public function talentInfoStore(Request $request)
    {
        HrmEmployeeTalentInfo::storeTalentInfo($request);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'talent')->with('talent_store_message',' --> has been added!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = HrmEmployee::findOrfail($id);
        $employeeContactInfo = HrmEmployeeContactInfo::where('employee_id', $id)->first();
        $employeeJobInfo = HrmEmployeeJobInfo::where('employee_id', $id)->first();
        $education = HrmEmployeeEducationInfo::where('employee_id',$id)->get();
        $employments = HrmEmployeeEmployment::where('employee_id',$id)->get();
        $educations = HrmEmployeeEducationInfo::where('employee_id',$id)->get();
        $familyInfos = HrmEmployeeFamilyInfo::where('employee_id', $id)->get();
        $supervisors = HrmEmployeeSupervisorInfo::where('employee_id', $id)->get();
        $languageInfos = HrmEmployeeLanguageSkill::where('employee_id', $id)->get();
        $socialMedias = HrmEmployeeSocialMediaInfo::where('employee_id', $id)->get();
        return view('modules.hrm.employee.show',compact(
            [
                'employee',
                'employeeContactInfo',
                'employeeJobInfo',
                'education',
                'employments',
                'educations',
                'familyInfos',
                'supervisors',
                'languageInfos',
                'socialMedias'
            ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = HrmEmployee::findOrfail($id);
        $bloods = HrmBlood::where('status','active')->get();
        $religions = HrmReligion::where('status','active')->get();
        $states = HrmState::all();
        $cities= HrmCity::all();
        $policeStations = HrmPoliceStation::all();
        $postOffices = HrmPostOffice::all();
        $contactEmployeeId = HrmEmployeeContactInfo::where('employee_id',$id)->count();
        $contactInfo = HrmEmployeeContactInfo::where('employee_id', $id)->first();

        $jobEmployeeId = HrmEmployeeJobInfo::where('employee_id',$id)->count();
        $jobInfo = HrmEmployeeJobInfo::where('employee_id', $id)->first();

        $familyInfos = HrmEmployeeFamilyInfo::where('employee_id', $id)->get();
        $educations = HrmEmployeeEducationInfo::where('employee_id', $id)->get();
        $employments = HrmEmployeeEmployment::where('employee_id', $id)->get();
        $supervisors = HrmEmployeeSupervisorInfo::where('employee_id',$id)->get();
        $documents = HrmEmployeeDocumentInfo::where('employee_id',$id)->get();
        $languageSkills = HrmEmployeeLanguageSkill::where('employee_id',$id)->get();
        $bankAccs = HrmEmployeeBankAccountInfo::where('employee_id',$id)->get();
        $socialMediaInfos = HrmEmployeeSocialMediaInfo::where('employee_id',$id)->get();
        $talentInfos = HrmEmployeeTalentInfo::where('employee_id',$id)->get();

        $employmentTypes = HrmEmploymentType::where('status','active')->get();
        $jobLocations = HrmJobLocation::where('status','active')->get();
        $departments = HrmDepartment::where('status','active')->get();
        $designations = HrmDesignation::where('status','active')->orderBy('designation_name','asc')->get();
        $grades = HrmGrade::where('status','active')->get();
        $shifts = HrmShift::where('status','active')->get();
        $relations = HrmRelation::where('status','active')->get();
        $hrmEduExamTitles = HrmEduExamTitle::where('status','active')->orderBy('exam_title','asc')->get();
        $hrmEduSubjects = HrmEduSubject::where('status','active')->orderBy('subject_name','asc')->get();
        $hrmUniversities = HrmUniversity::where('status','active')->orderBy('university_name','asc')->get();
        $employees = HrmEmployee::where('job_status','In Service')->get();
        $documentCategories = HrmDocumentCategory::all();
        $languages = HrmLanguage::where('status','active')->get();
        $languageProficiencies = HrmLanaguageProficiencyLevel::where('status','active')->get();
        $banks = HrmBank::all();
        $socialMedias = HrmSocialMedia::where('status','active')->get();
        $talents = HrmTalent::all();
        $nationalities = HrmNationality::where('status','active')->get();
        return view('modules.hrm.employee.edit',compact(['postOffices','policeStations','nationalities','talents','talentInfos','socialMediaInfos','socialMedias','bankAccs','banks','languageSkills','languageProficiencies','languages','documents','documentCategories','supervisors','employees','employments','hrmUniversities','hrmEduSubjects','hrmEduExamTitles','educations','familyInfos','employee','bloods','religions','states','cities','contactEmployeeId','contactInfo','employmentTypes','jobLocations','departments','designations','grades','shifts','jobEmployeeId','jobInfo','relations']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        HrmEmployee::updateEmployee($request, $id);
        return redirect()->route('hrm.employee.edit', ['id' => $id])->with('personal_update_message', ' --> has been updated!!');
    }

    public function contactInformationUpdate(Request $request, $id)
    {
        HrmEmployeeContactInfo::updateEmployeeContactInfo($request, $id);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'contact')->with('contact_update_message',' --> has been updated!!');
    }

    public function jobInformationUpdate(Request $request, $id)
    {
        HrmEmployeeJobInfo::updateJobInfo($request, $id);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'job')->with('job_update_message',' --> has been updated!!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function familyInformationDestroy(Request $request, $id)
    {
        HrmEmployeeFamilyInfo::familyInfoDestroy($id);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'family')->with('family_destroy_message',' --> has been deleted!!');
    }

    public function educationInformationDestroy(Request $request, $id)
    {
        HrmEmployeeEducationInfo::destroyEducationInfo($id);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'education')->with('education_destroy_message',' --> has been deleted!!');
    }

    public function employmentInformationDestroy(Request $request, $id)
    {
        HrmEmployeeEmployment::destroyEmploymentInfo($id);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'employment')->with('employment_destroy_message',' --> has been deleted!!');
    }

    public function supervisorInformationDestroy(Request $request, $id)
    {
        HrmEmployeeSupervisorInfo::destroySupervisorInfo($id);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'supervisor')->with('supervisor_destroy_message',' --> has been deleted!!');
    }

    public function documentInformationDestroy(Request $request, $id)
    {
        HrmEmployeeDocumentInfo::destroyDocumentInfo($id);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'document')->with('document_destroy_message',' --> has been deleted!!');
    }

    public function languageInformationDestroy(Request $request, $id)
    {
        HrmEmployeeLanguageSkill::destroyLanguageSkillInfo($id);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'language')->with('language_destroy_message',' --> has been deleted!!');
    }

    public function bankInformationDestroy(Request $request, $id)
    {
        HrmEmployeeBankAccountInfo::destroyBankAccountInfo($id);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'bank')->with('bank_destroy_message',' --> has been deleted!!');
    }

    public function socialMediaDestroy(Request $request, $id)
    {
        HrmEmployeeSocialMediaInfo::destroySocialMediaInfo($id);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'social')->with('social_destroy_message',' --> has been deleted!!');
    }

    public function talentInfoDestroy(Request $request, $id)
    {
        HrmEmployeeTalentInfo::destroyTalentInfo($id);
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'talent')->with('talent_destroy_message',' --> has been deleted!!');
    }
}

<?php

namespace App\Http\Controllers\HRM\employee;

use App\Http\Controllers\Controller;
use App\Models\HRM\employee\HrmEmployee;
use App\Models\HRM\employee\HrmEmployeeContactInfo;
use App\Models\HRM\employee\HrmEmployeeJobInfo;
use App\Models\HRM\setup\HrmBlood;
use App\Models\HRM\setup\HrmCity;
use App\Models\HRM\setup\HrmDepartment;
use App\Models\HRM\setup\HrmDesignation;
use App\Models\HRM\setup\HrmEmploymentType;
use App\Models\HRM\setup\HrmGrade;
use App\Models\HRM\setup\HrmJobLocation;
use App\Models\HRM\setup\HrmRelation;
use App\Models\HRM\setup\HrmReligion;
use App\Models\HRM\setup\HrmShift;
use App\Models\HRM\setup\HrmState;
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
        return redirect()->route('hrm.employee.edit', ['id' => $request->employee_id])->with('key', 'job')->with('job_store_message',' --> has been added!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "cooming soon!!";
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
        $contactEmployeeId = HrmEmployeeContactInfo::where('employee_id',$id)->count();
        $contactInfo = HrmEmployeeContactInfo::where('employee_id', $id)->first();

        $jobEmployeeId = HrmEmployeeJobInfo::where('employee_id',$id)->count();
        $jobInfo = HrmEmployeeJobInfo::where('employee_id', $id)->first();

        $familyEmployeeId = HrmEmployeeJobInfo::where('employee_id',$id)->count();
        $familyInfo = HrmEmployeeJobInfo::where('employee_id', $id)->get();

        $employmentTypes = HrmEmploymentType::where('status','active')->get();
        $jobLocations = HrmJobLocation::where('status','active')->get();
        $departments = HrmDepartment::where('status','active')->get();
        $designations = HrmDesignation::where('status','active')->orderBy('designation_name','asc')->get();
        $grades = HrmGrade::where('status','active')->get();
        $shifts = HrmShift::where('status','active')->get();
        $relations = HrmRelation::where('status','active')->get();
        return view('modules.hrm.employee.edit',compact(['familyEmployeeId','familyInfo','employee','bloods','religions','states','cities','contactEmployeeId','contactInfo','employmentTypes','jobLocations','departments','designations','grades','shifts','jobEmployeeId','jobInfo','relations']));
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
}

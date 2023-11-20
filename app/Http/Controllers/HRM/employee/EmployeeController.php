<?php

namespace App\Http\Controllers\HRM\employee;

use App\Http\Controllers\Controller;
use App\Models\HRM\employee\HrmEmployee;
use App\Models\HRM\setup\HrmBlood;
use App\Models\HRM\setup\HrmReligion;
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

        return view('modules.hrm.employee.edit',compact(['employee','bloods','religions','states']));
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
        //
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

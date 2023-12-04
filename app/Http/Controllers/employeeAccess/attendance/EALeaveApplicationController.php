<?php

namespace App\Http\Controllers\employeeAccess\attendance;

use App\Http\Controllers\Controller;
use App\Models\employeeAccess\attendance\EALeaveApplication;
use App\Models\HRM\employee\HrmEmployee;
use App\Models\HRM\setup\HrmLeaveType;
use App\Models\User;
use Illuminate\Http\Request;

class EALeaveApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaveApplications = EALeaveApplication::all();
        return view('modules.employeeAccess.attendance.leave.index',compact('leaveApplications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = HrmEmployee::where('job_status','In Service')->get();
        $types = HrmLeaveType::where('status','active')->get();
        return view('modules.employeeAccess.attendance.leave.create',compact(['users','types']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        EALeaveApplication::storeLeaveApplication($request);
        return redirect('/employee-access/attendance/leave-application/')->with('store_message','A leave application has been successfully created!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

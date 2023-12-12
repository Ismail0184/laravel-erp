<?php

namespace App\Http\Controllers\employeeAccess\attendance;

use App\Http\Controllers\Controller;
use App\Models\employeeAccess\attendance\EaEarlyLeaveApplication;
use App\Models\HRM\employee\HrmEmployee;
use Illuminate\Http\Request;
use Auth;

class EaEarlyLeaveApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $earlyLeaveApplications = EaEarlyLeaveApplication::where('employee_id',Auth::user()->id)->get();
        return view('modules.employeeAccess.attendance.earlyLeave.index',compact('earlyLeaveApplications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = HrmEmployee::where('job_status','In Service')->get();
        return view('modules.employeeAccess.attendance.earlyLeave.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        EaEarlyLeaveApplication::storeEarlyLeaveApplication($request);
        return redirect('/employee-access/attendance/early-leave-application/')->with('store_message','A early leave application has been successfully created!!');
    }

    public function send(Request $request, $id)
    {
        EaEarlyLeaveApplication::sendEarlyLeaveApplication($request, $id);
        return redirect('/employee-access/attendance/early-leave-application/')->with('send_message','This early leave application has been sent!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $earlyLeaveApplication = EaEarlyLeaveApplication::findOrfail($id);
        return view('modules.employeeAccess.attendance.earlyLeave.show',compact('earlyLeaveApplication'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = HrmEmployee::where('job_status','In Service')->get();
        $earlyLeaveApplication = EaEarlyLeaveApplication::findOrfail($id);
        return view('modules.employeeAccess.attendance.earlyLeave.create',compact('users','earlyLeaveApplication'));

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
        EaEarlyLeaveApplication::updateEarlyLeaveApplication($request, $id);
        return redirect('/employee-access/attendance/early-leave-application/')->with('update_message','A early leave application has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EaEarlyLeaveApplication::destroyEarlyLeaveApplication($id);
        return redirect('/employee-access/attendance/early-leave-application/')->with('destroy_message','A early leave application has been updated!!');
    }
}

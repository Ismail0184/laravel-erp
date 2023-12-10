<?php

namespace App\Http\Controllers\employeeAccess\attendance;

use App\Http\Controllers\Controller;
use App\Models\employeeAccess\attendance\EaLateattendance;
use App\Models\employeeAccess\attendance\EaLeaveApplication;
use App\Models\HRM\employee\HrmEmployee;
use Illuminate\Http\Request;
use Auth;
use PDF;

class EALateAttendanceApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lateAttendances = EaLateattendance::where('employee_id',Auth::user()->id)->get();
        return view('modules.employeeAccess.attendance.lateAttendance.index',compact('lateAttendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = HrmEmployee::where('job_status','In Service')->get();
        return view('modules.employeeAccess.attendance.lateAttendance.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        EaLateattendance::storeLateAttendanceApplication($request);
        return redirect('/employee-access/attendance/late-attendance-application/')->with('store_message','A late attendance application has been successfully drafted!!');
    }

    public function send(Request $request, $id)
    {
        EaLateattendance::sendLateAttendanceApplication($request, $id);
        return redirect('/employee-access/attendance/late-attendance-application/')->with('send_message','This Late Attendance application has been sent!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lateAttendanceApplication = EaLateattendance::findOrfail($id);
        return view('modules.employeeAccess.attendance.lateAttendance.show',compact('lateAttendanceApplication'));
    }

    public function download($id)
    {
        $this->application = EaLateattendance::find($id);
        $pdf = PDF::loadView('modules.employeeAccess.attendance.lateAttendance.download', [
            'lateAttendanceApplication' =>$this->application,
        ]);
        return $pdf->download('LateAttendanceApplication_'.$id.'.pdf');
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
        $lateAttendanceApplication = EaLateattendance::findOrfail($id);
        return view('modules.employeeAccess.attendance.lateAttendance.create',compact('users','lateAttendanceApplication'));
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
        EaLateattendance::updateLateAttendanceApplication($request, $id);
        return redirect('/employee-access/attendance/late-attendance-application/')->with('update_message','This Late Attendance application has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EaLateattendance::destroyLateAttendanceApplication($id);
        return redirect('/employee-access/attendance/late-attendance-application/')->with('destroy_message','This Late Attendance application has been deleted!!');
    }
}

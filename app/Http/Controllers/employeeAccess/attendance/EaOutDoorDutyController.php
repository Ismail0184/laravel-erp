<?php

namespace App\Http\Controllers\employeeAccess\attendance;

use App\Http\Controllers\Controller;
use App\Models\employeeAccess\attendance\EaLateAttendance;
use App\Models\employeeAccess\attendance\EaOutdoorDuty;
use App\Models\HRM\employee\HrmEmployee;
use Illuminate\Http\Request;
use Auth;
use PDF;

class EaOutDoorDutyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outdoorDutyApplications = EaOutdoorDuty::where('employee_id',Auth::user()->id)->get();
        return view('modules.employeeAccess.attendance.outDoorDuty.index',compact('outdoorDutyApplications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = HrmEmployee::where('job_status','In Service')->get();
        return view('modules.employeeAccess.attendance.outDoorDuty.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        EaOutdoorDuty::storeOutdoorDutyApplication($request);
        return redirect('/employee-access/attendance/outdoor-duty/')->with('store_message','A new outdoor duty application has been successfully created!!');
    }

    public function send(Request $request, $id)
    {
        EaOutdoorDuty::sendOutdoorDutyApplication($request, $id);
        return redirect('/employee-access/attendance/outdoor-duty/')->with('send_message','This OD application (A.id='.$id.') has been sent!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $outdoorDutyApplication = EaOutdoorDuty::findOrfail($id);
        return view('modules.employeeAccess.attendance.outDoorDuty.show',compact('outdoorDutyApplication'));
    }

    public function download($id)
    {
        $this->application = EaOutdoorDuty::find($id);
        $pdf = PDF::loadView('modules.employeeAccess.attendance.outDoorDuty.download', [
            'outdoorDutyApplication' =>$this->application,
        ]);
        return $pdf->download('outdoorDutyApplication_'.$id.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $outdoorDutyApplication = EaOutdoorDuty::findOrfail($id);
        $users = HrmEmployee::where('job_status','In Service')->get();
        return view('modules.employeeAccess.attendance.outDoorDuty.create',compact(['outdoorDutyApplication','users']));
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
        EaOutdoorDuty::updateOutdoorDutyApplication($request, $id);
        return redirect('/employee-access/attendance/outdoor-duty/')->with('update_message','This OD Application (A.id='.$id.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EaOutdoorDuty::destroyOutdoorDutyApplication($id);
        return redirect('/employee-access/attendance/outdoor-duty/')->with('destroy_message','This OD Application (A.id='.$id.') has been deleted!!');
    }
}

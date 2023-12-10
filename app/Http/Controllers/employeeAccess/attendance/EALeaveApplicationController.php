<?php

namespace App\Http\Controllers\employeeAccess\attendance;

use App\Http\Controllers\Controller;
use App\Models\employeeAccess\attendance\EaLeaveApplication;
use App\Models\HRM\employee\HrmEmployee;
use App\Models\HRM\setup\HrmLeaveType;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use PDF;

class EALeaveApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaveApplications = EaLeaveApplication::where('employee_id',Auth::user()->id)->get();
        return view('modules.employeeAccess.attendance.leave.index',compact('leaveApplications'));
    }


    public function getTypeBalance($category)
    {
        $policy = HrmLeaveType::where('id', $category)->value('yearly_leave_days');
        $type = HrmLeaveType::find($category);
        $taken = $type->LeaveTaken->sum('total_days');
        $balance = $policy-$taken;
        return response()->json(['balance' => $balance]);
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

        $leaveTypes = HrmLeaveType::with('LeaveTaken')->where('status','active')->get();

        $leave_taken = [];
        foreach ($leaveTypes as $type) {
            $categoryStock = $type->LeaveTaken->sum('total_days');

            $leave_taken[] = [
                'leave_type_name' => $type->leave_type_name,
                'yearly_leave_days'   => $type->yearly_leave_days,
                'total_leave_taken'   => $categoryStock,
            ];
        }


        return view('modules.employeeAccess.attendance.leave.create',compact(['users','types','leave_taken']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        EaLeaveApplication::storeLeaveApplication($request);
        return redirect('/employee-access/attendance/leave-application/')->with('store_message','A leave application has been successfully created!!');
    }


    public function send(Request $request, $id)
    {
        EaLeaveApplication::sendLeaveApplication($request, $id);
        return redirect('/employee-access/attendance/leave-application/')->with('send_message','This Leave application has been sent!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $leaveApplication = EaLeaveApplication::findOrfail($id);
        return view('modules.employeeAccess.attendance.leave.show',compact('leaveApplication'));
    }

    public function download($id)
    {
        $this->application = EaLeaveApplication::find($id);
        $pdf = PDF::loadView('modules.employeeAccess.attendance.leave.download', [
            'leaveApplication' =>$this->application,
        ]);
        return $pdf->download('leaveApplication_'.$id.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leaveApplication = EaLeaveApplication::findOrfail($id);
        $users = HrmEmployee::where('job_status','In Service')->get();
        $types = HrmLeaveType::where('status','active')->get();
        $leaveTypes = HrmLeaveType::with('LeaveTaken')->where('status','active')->get();

        $leave_taken = [];
        foreach ($leaveTypes as $type) {
            $categoryStock = $type->LeaveTaken->sum('total_days');

            $leave_taken[] = [
                'leave_type_name' => $type->leave_type_name,
                'yearly_leave_days'   => $type->yearly_leave_days,
                'total_leave_taken'   => $categoryStock,
            ];
        }
        return view('modules.employeeAccess.attendance.leave.create',compact(['leaveApplication','users','types','leave_taken']));
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
        EaLeaveApplication::updateLeaveApplication($request, $id);
        return redirect('/employee-access/attendance/leave-application/')->with('update_message','This Leave application has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EaLeaveApplication::destroyLeaveApplication($id);
        return redirect('/employee-access/attendance/leave-application/')->with('destroy_message','This Leave application has been deleted!!');
    }
}

<?php

namespace App\Http\Controllers\employeeAccess\approval;

use App\Http\Controllers\Controller;
use App\Models\employeeAccess\attendance\EaLeaveApplication;
use App\Models\HRM\setup\HrmLeaveType;
use Illuminate\Http\Request;
use Auth;

class EaApprovalLeaveController extends Controller
{
    public function index()
    {
        $leaveApplications = EaLeaveApplication::where('year',date('Y'))->where('status','RECOMMENDED')->where('recommended_by',Auth::user()->id)->get();
        return view('modules.employeeAccess.approval.leave.index',compact('leaveApplications'));
    }

    public function show($id)
    {
        $leaveTypes = HrmLeaveType::with('LeaveGranted')->with('LeaveApplied')->where('status','active')->get();
        $leave_taken = [];
        foreach ($leaveTypes as $type) {
            $categoryStock = $type->LeaveGranted->sum('total_days');
            $leaveApplied = $type->LeaveApplied->sum('total_days');

            $leave_taken[] = [
                'leave_type_name'       => $type->leave_type_name,
                'yearly_leave_days'     => $type->yearly_leave_days,
                'total_leave_taken'     => $categoryStock,
                'total_leave_applied'   => $leaveApplied,
            ];
        }
        $leaveApplication = EaLeaveApplication::findOrfail($id);
        if (empty($leaveApplication->approved_viewed_at))
        {
            EaLeaveApplication::approvePersonView($id);
        }
        $leaveHistories = EaLeaveApplication::where('employee_id',$leaveApplication->employee_id)->whereNotIn('id',[$id])->orderBy('id','desc')->limit('5')->get();
        return view('modules.employeeAccess.approval.leave.show',compact(['leaveApplication','leave_taken','leaveHistories']));
    }

    public function approve(Request $request, $id)
    {
        EaLeaveApplication::approveLeaveApplication($request, $id);
        return redirect('/employee-access/approval/leave/')->with('approved_message','This leave application (Application ID # '.$id.') has been recommended!!');
    }

    public function reject(Request $request, $id)
    {
        EaLeaveApplication::rejectALeaveApplication($request, $id);
        return redirect('/employee-access/approval/leave/')->with('rejected_message','This leave application (Application ID # '.$id.') has been rejected!!');
    }
}

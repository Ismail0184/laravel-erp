<?php

namespace App\Http\Controllers\employeeAccess\recommendation;

use App\Http\Controllers\Controller;
use App\Models\employeeAccess\attendance\EaLeaveApplication;
use App\Models\HRM\setup\HrmLeaveType;
use Illuminate\Http\Request;
use Auth;

class EaRecommendationLeaveController extends Controller
{
    public function index()
    {
        $leaveApplications = EaLeaveApplication::where('year',date('Y'))->where('status','PENDING')->where('recommended_by',Auth::user()->id)->get();
        return view('modules.employeeAccess.recommendation.leave.index',compact('leaveApplications'));
    }

    public function show($id)
    {
        $types = HrmLeaveType::where('status','active')->get();

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
        return view('modules.employeeAccess.recommendation.leave.show',compact(['leaveApplication','leave_taken']));
    }

    public function reject($id)
    {

    }

    public function recommend(Request $request, $id)
    {
        EaLeaveApplication::recommendLeaveApplication($request, $id);
        return redirect('/employee-access/recommendation/leave/')->with('recommended_message','This leave application (Application Dd # '.$id.') has been recommended!!');
    }
}

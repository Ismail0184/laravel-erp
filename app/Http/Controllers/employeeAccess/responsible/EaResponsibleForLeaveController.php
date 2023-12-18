<?php

namespace App\Http\Controllers\employeeAccess\responsible;

use App\Http\Controllers\Controller;
use App\Models\employeeAccess\attendance\EaLeaveApplication;
use App\Models\HRM\setup\HrmLeaveType;
use Illuminate\Http\Request;
use Auth;

class EaResponsibleForLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaveApplications = EaLeaveApplication::where('year',date('Y'))->whereNotIn('status',['DRAFTED','REJECTED','DELETED'])->where('responsible_person_acceptance_status','PENDING')->where('responsible_person',Auth::user()->id)->get();
        return view('modules.employeeAccess.responsible.leave.index',compact('leaveApplications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        if (empty($leaveApplication->responsible_person_viewed_at))
        {
            EaLeaveApplication::responsiblePersonView($id);
        }
        return view('modules.employeeAccess.responsible.leave.show',compact(['leaveApplication','leave_taken']));
    }

    public function accept(Request $request, $id)
    {
        EaLeaveApplication::acceptLeaveApplication($request, $id);
        return redirect('/employee-access/responsible-for/leave/')->with('accept_message','This leave application (Application ID # '.$id.') has been accepted!!');

    }
}

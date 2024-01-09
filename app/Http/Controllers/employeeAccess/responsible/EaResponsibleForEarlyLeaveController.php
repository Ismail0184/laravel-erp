<?php

namespace App\Http\Controllers\employeeAccess\responsible;

use App\Http\Controllers\Controller;
use App\Models\employeeAccess\attendance\EaEarlyLeaveApplication;
use Illuminate\Http\Request;
use Auth;

class EaResponsibleForEarlyLeaveController extends Controller
{
    //

    public function index()
    {
        $earlyLeaveApplications = EaEarlyLeaveApplication::where('year',date('Y'))->whereNotIn('status',['DRAFTED','REJECTED','DELETED'])->where('responsible_person_acceptance_status','PENDING')->where('responsible_person',Auth::user()->id)->get();
        return view('modules.employeeAccess.responsible.earlyLeave.index',compact('earlyLeaveApplications'));
    }


    public function show($id)
    {
        $earlyLeaveApplications = EaEarlyLeaveApplication::findOrfail($id);
        if (empty($leaveApplication->responsible_person_viewed_at))
        {
            EaEarlyLeaveApplication::responsiblePersonView($id);
        }
        return view('modules.employeeAccess.responsible.earlyLeave.show',compact('earlyLeaveApplications'));
    }

    public function accept(Request $request, $id)
    {
        EaEarlyLeaveApplication::acceptEarlyLeaveApplication($request, $id);
        return redirect('/employee-access/responsible-for/early-leave/')->with('accept_message','This leave application (Application ID # '.$id.') has been accepted!!');

    }
}

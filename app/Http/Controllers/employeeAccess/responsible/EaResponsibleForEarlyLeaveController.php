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
}

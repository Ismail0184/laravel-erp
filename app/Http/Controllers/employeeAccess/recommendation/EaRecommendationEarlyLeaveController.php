<?php

namespace App\Http\Controllers\employeeAccess\recommendation;

use App\Http\Controllers\Controller;
use App\Models\employeeAccess\attendance\EaEarlyLeaveApplication;
use Illuminate\Http\Request;
use Auth;

class EaRecommendationEarlyLeaveController extends Controller
{

    public function index()
    {
        $earlyLeaveApplications = EaEarlyLeaveApplication::where('year',date('Y'))->where('status','PENDING')->where('recommended_status','PENDING')->where('recommended_by',Auth::user()->id)->get();
        return view('modules.employeeAccess.recommendation.earlyLeave.index',compact('earlyLeaveApplications'));
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
}
